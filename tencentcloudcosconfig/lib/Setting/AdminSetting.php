<?php
/*
 * Copyright (C) 2020 Tencent Cloud.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace OCA\TencentcloudCOSConfig\Setting;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IL10N;
use OCP\Settings\ISettings;
use OC\Files\ObjectStore\TencentCloud;


class AdminSetting implements ISettings {


    /** @var IConfig */
    private $config;

    /** @var IL10N */
    private $l;


    /**
     * Admin constructor.
     *
     * @param IConfig $config
     * @param IL10N $l
     */
    public function __construct(IConfig $config, IL10N $l)
    {
        $this->config = $config;
        $this->l = $l;
    }

    /**
     * @return TemplateResponse
     */
    public function getForm()
    {
        $objectstore = $this->config->getSystemValue('objectstore',[]);
        if (!isset($objectstore['arguments'])||empty($objectstore['arguments'])) {
            $objectstore['arguments'] = [
                'key'    => '',
                'secret' => '',
                'hostname' => '',
                'bucket' => '',
                'use_ssl' => true,
            ];
        }
        return new TemplateResponse('tencentcloudcosconfig',
            'admin', $objectstore['arguments']);
    }

    /**
     * @return string the section ID, e.g. 'sharing'
     */
    public function getSection()
    {
        return 'tencentcloudcosconfig';
    }

    /**
     * @return int whether the form should be rather on the top or bottom of
     * the admin section. The forms are arranged in ascending order of the
     * priority values. It is required to return a value between 0 and 100.
     */
    public function getPriority()
    {
        return 100;
    }

}