<?php

/**
 * @var \League\Plates\Template\Template $this
 */

$this->layout('admin/layout');

?>
<table class="form-table">
    <tr>
        <th>
            <label for="input-google-analytics-id">
                <?= __('Google analytics id', 'wordpress-theme') ?>
            </label>
        </th>
        <td>
            <input
                class="regular-text"
                id="input-google-analytics-id"
                name="google-analytics-id"
                type="text"
                value="<?= get_option('wordpress-theme/general-settings/google-analytics-id') ?>"
            >
        </td>
    </tr>
</table>
