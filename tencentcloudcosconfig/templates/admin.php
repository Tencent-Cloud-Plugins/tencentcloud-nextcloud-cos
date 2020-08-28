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
/** @var $l \OCP\IL10N */
/** @var $_ array */

script('tencentcloudcosconfig', 'script');
style('tencentcloudcosconfig', 'style');
?>
<div id="tencentcloudcosconfig" class="section">
    <h2><?php p($l->t('tencentcloudcosconfig'));?></h2>
    <form>
        <table>
            <tr></tr>
            <tr>
                <td><label for="secretId">secretId：</label></td>
                <td><input class="cos-input" type="password" id="secretId" autocomplete="off"
                           value="<?php echo $_['key'] ?>">
                    <a href="#" class="toggle-password" id="toggle-secretId"><img src="/core/img/actions/toggle.svg"></a>
                </td>
            </tr>
            <tr>
                <td><label for="secretKey">secretKey：</label></td>
                <td><input class="cos-input" type="password" id="secretKey" autocomplete="off"
                           value="<?php echo $_['secret'] ?>">
                    <a href="#" class="toggle-password" id="toggle-secretKey"><img src="/core/img/actions/toggle.svg"></a>
                    <em id="description"><?php p($l->t('visit'));?> <a href="https://console.qcloud.com/cam/capi" target="_blank"><?php p($l->t('secret_manage'));?></a>
                        <?php p($l->t('secret_desc'));?></em></td>
            </tr>
            <tr>
                <td><label for="bucket">bucket：</label></td>
                <td>
                    <input class="cos-input" type="text" id="bucket" autocomplete="off" value="<?php echo $_['bucket'] ?>">
                    <em><?php p($l->t('visit'));?><a href="https://console.cloud.tencent.com/cos5/bucket" target="_blank"><?php p($l->t('tencent_cloud_console'));?></a><?php p($l->t('creat_bucket'));?></em>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="hostname"><?php p($l->t('hostname'));?>：</label>
                </td>
                <td>
                    <input class="cos-input" type="text" id="hostname" autocomplete="off" value="<?php echo $_['hostname'] ?>">
                    <em><?php p($l->t('hostname_desc'));?></em>
                </td>
            </tr>

            <tr>
                <td><button type="button" id="save-config"><?php p($l->t('submit'));?></button></td>
            </tr>
        </table>
    </form>
</div>