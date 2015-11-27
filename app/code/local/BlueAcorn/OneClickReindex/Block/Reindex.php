<?php

class BlueAcorn_OneClickReindex_Block_Reindex extends Mage_Core_Block_Template {

    public function reindexAll() {

        Mage::log("*************",null,"oneclickreindex.log");

        $response_array = array();

        try {

            exec('/usr/bin/php ' . Mage::getBaseDir() . '/shell/indexer.php reindexall', $output, $status);
            $output = implode("\n", $output);
            Mage::log($output,null,"oneclickreindex.log");

            $response_array['reindex'] = $output;

            $response_array['cache'] = $this->clearCache();
        }
        catch(Exception $e) {
            $response_array['exception'] = 'There was an error executing the reindex.';
            Mage::log($e->getMessage(),null,"oneclickreindex.log");
            Mage::dispatchEvent('shell_reindex_init_process');
        }

        return $response_array;
    }

    public function clearCache()
    {
        try {
            $cacheTypes = Mage::app()->useCache();
            foreach ($cacheTypes as $type => $option) {
                Mage::app()->getCacheInstance()->cleanType($type);
                Mage::log("Cache '" . $type . "' cleaned",null,"oneclickreindex.log");

            }
            $message = 'Clean All Caches Successful';

        } catch (Exception $e) {
            Mage::log($e->getMessage(),null,"oneclickreindex.log");
            $message = 'Clean Cache Failed';
        }

        return $message;
    }
}