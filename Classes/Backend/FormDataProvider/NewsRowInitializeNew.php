<?php

namespace GeorgRinger\News\Backend\FormDataProvider;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

/**
 * Fill the news records with default values
 */
class NewsRowInitializeNew implements FormDataProviderInterface
{

    /**
     * @param array $result
     * @return array
     */
    public function addData(array $result)
    {
        if ($result['command'] !== 'new' || $result['tableName'] !== 'tx_news_domain_model_news') {
            return $result;
        }

        $result['databaseRow']['datetime'] = $GLOBALS['EXEC_TIME'];

        if (is_array($result['pageTsConfig']['tx_news.'])
            && is_array($result['pageTsConfig']['tx_news.']['predefine.'])
            && isset($result['pageTsConfig']['tx_news.']['predefine.']['archive'])
        ) {
            $calculatedTime = strtotime($result['pageTsConfig']['tx_news.']['predefine.']['archive']);

            if ($calculatedTime !== false) {
                $result['databaseRow']['archive'] = $calculatedTime;
            }
        }

        return $result;
    }
}