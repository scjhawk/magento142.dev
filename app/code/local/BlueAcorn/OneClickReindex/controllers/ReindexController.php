<?php

class BlueAcorn_OneClickReindex_ReindexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $block = Mage::app()->getLayout()->createBlock('blueacorn_oneclickreindex/reindex');
        
        $response_array = $block->reindexAll();

        Mage::app()->getResponse()->setBody(json_encode($response_array));
    }
}