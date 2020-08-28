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

use OCP\IL10N;
use OCP\Settings\IIconSection;
use OCP\IURLGenerator;

class AdminSection implements IIconSection
{

    /** @var IL10N */
    private $l;

    /** @var IURLGenerator */
    private $urlGenerator;

    public function __construct(IURLGenerator $urlGenerator,IL10N $l)
    {
        $this->urlGenerator = $urlGenerator;
        $this->l = $l;
    }

    /**
     * returns the ID of the section. It is supposed to be a lower case string
     *
     * @returns string
     */
    public function getID()
    {
        return 'tencentcloudcosconfig';
    }

    /**
     * returns the translated name as it should be displayed, e.g. 'LDAP / AD
     * integration'. Use the L10N service to translate it.
     *
     * @return string
     */
    public function getName()
    {
        return $this->l->t('tencentcloudcosconfig');
    }

    /**
     * @return int whether the form should be rather on the top or bottom of
     * the settings navigation. The sections are arranged in ascending order of
     * the priority values. It is required to return a value between 0 and 99.
     */
    public function getPriority()
    {
        return 80;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->urlGenerator->imagePath('tencentcloudcosconfig', 'tencent.svg');
    }

}