<?php

class BlueAcorn_OneClickReindex_Model_Observer
{
    public function addReindexAllButton($observer)
    {
        $container = $observer->getBlock();

        if(null !== $container && $container->getType() == 'enterprise_index/adminhtml_process') 
        {
            $data = array(
            'label'     => Mage::helper('blueacorn_oneclickreindex')->__('Reindex All'),
            'onclick'   => 'reindexall()',
            );
                
            $container->addButton('reindexall', $data,0,100,'footer','footer');
        }

        return $this;
    }
    
//    public function cronReindex()
//    {
//        Mage::log("*** SCHEDULED REINDEX BEGIN " . date('r') . " ***",null,"oneclickreindex_cron.log");
//        
//        $block = Mage::app()->getLayout()->createBlock('blueacorn_oneclickreindex/reindex');
//
//        $response_array = $block->reindexAll();
//
//        if ($response_array['exception'])
//                Mage::log($response_array['exception'],null,"oneclickreindex_cron.log");
//            else
//                Mage::log($response_array['reindex'] . "\r\n" . $response_array['cache'],null,"oneclickreindex_cron.log");
//        
//
//        Mage::log("*** SCHEDULED REINDEX BEGIN " . date('r') . " ***",null,"oneclickreindex_cron.log");
//    }
}