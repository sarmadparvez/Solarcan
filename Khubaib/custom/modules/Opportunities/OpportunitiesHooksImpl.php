<?php

class OpportunitiesHooksImpl
{

    function beforeSave($bean, $event, $arguments)
    {
        /**
         * Workflows: Contact Status Workflow/Behaviour
         */
        $this->setContactStatus($bean, $event, $arguments);
    }

    function setContactStatus(&$bean, &$event, &$arguments)
    {
        if ($bean->status != $bean->fetched_row['status'] && $bean->status === 'vente') {
            if ($bean->load_relationship('contacts')) {
                $contacts = $bean->contacts->getBeans();
                if (count($contacts) > 0) {
                    $contact = current($contacts);
                    while ($contact) {
                        if ($bean->load_relationship('dsm_suivi_de_vente_opportunities')) {
                            $suivi_de_ventes = $bean->dsm_suivi_de_vente_opportunities->getBeans();
                            if (count($suivi_de_ventes) > 0) {   // one-to-one relationship so it will be 1 at max
                                $suivi_de_vente = current($suivi_de_ventes);
                                if ($suivi_de_vente->statut_suivi == 'refus_en_nego' ||
                                    $suivi_de_vente->statut_suivi == 'refus_officiel' ||
                                    $suivi_de_vente->statut_suivi == 'annule_par_representant' ||
                                    $suivi_de_vente->statut_suivi == 'annule_par_client') {
                                    $contact->statut_contact = 'rencontre';
                                } else {
                                    $contact->statut_contact = 'client';
                                }
                            } else {
                                $contact->statut_contact = 'client';
                            }
                        } else {
                            $contact->statut_contact = 'client';
                        }
                        $contact->save();
                        $contact = next($contacts);
                    }
                }
            }
        }
    }
}
