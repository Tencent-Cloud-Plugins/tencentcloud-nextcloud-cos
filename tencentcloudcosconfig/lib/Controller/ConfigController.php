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
namespace OCA\TencentcloudCOSConfig\Controller;

use OCA\TencentcloudCOSConfig\UsageDataReport;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\Files\IAppData;
use OCP\IConfig;
use OCP\IL10N;
use OCP\IRequest;
use OC\Files\ObjectStore\S3;

class ConfigController extends Controller
{
    const SUCCESS_CODE = 0;
    const EMPTY_CONFIG_CODE = 100000;
    const ERROR_CONFIG_CODE = 100001;

	/** @var IL10N */
	private $l;
	/** @var IAppData */
	private $appData;
    /** @var IConfig */
    private $config;
	/**
	 * ThemingController constructor.
	 *
	 * @param string $appName
	 * @param IRequest $request
	 * @param IL10N $l
	 * @param IAppData $appData
	 * @param IConfig $config
	 */
	public function __construct(
		$appName,
		IRequest $request,
		IL10N $l,
		IAppData $appData,
        IConfig $config) {
		parent::__construct($appName, $request);

		$this->l = $l;
		$this->appData = $appData;
		$this->config = $config;
	}

	/**
	 * Upload an icon to the appdata folder
	 *
	 * @return DataResponse
	 */
	public function saveConfigs() {
        try {
            $configs = $this->getValidConfigs();
            $configs = [
                'class' => '\\OC\\Files\\ObjectStore\\S3',
                'arguments' => $configs
            ];
            $this->config->setSystemValue('objectstore',$configs);
            (new UsageDataReport($configs['arguments']))->report();
            return new DataResponse([
                'code' => self::SUCCESS_CODE,
                'msg' => $this->l->t('saved'),
            ]);
        } catch (\Exception $e){
            return new DataResponse([
                'code' => $e->getCode(),
                'msg'=> $e->getMessage(),
            ]);
        }
	}

	private function getValidConfigs() {
        $configs = [];
        $configs['key'] = trim($this->request->getParam('key',''));
        if (empty($configs['key'])) {
            throw new \Exception($this->l->t('empty_secretId'),self::EMPTY_CONFIG_CODE);
        }
        $configs['secret'] = trim($this->request->getParam('secret',''));
        if (empty($configs['secret'])) {
            throw new \Exception($this->l->t('empty_secretKey'),self::EMPTY_CONFIG_CODE);
        }
        $configs['bucket'] = trim($this->request->getParam('bucket',''));
        if (empty($configs['bucket'])) {
            throw new \Exception($this->l->t('empty_bucket'),self::EMPTY_CONFIG_CODE);
        }
        $configs['hostname'] = trim($this->request->getParam('hostname',''));
        $pattern = '/(https?:\/\/)?'.$configs['bucket'].'\./';
        $configs['hostname'] = preg_replace($pattern,'',$configs['hostname']);

        if (empty($configs['hostname'])) {
            throw new \Exception($this->l->t('error_hostname'),self::EMPTY_CONFIG_CODE);
        }

        $configs['use_ssl'] = true;
        $configs['autocreate'] = false;
        return $configs;
    }
}
