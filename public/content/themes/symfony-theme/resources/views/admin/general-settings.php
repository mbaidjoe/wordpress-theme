<?php

?>
<table class="form-table">
    <tr>
        <th>
            <label for="input-google-analytics-id">
                <?= __('Google analytics id', 'symfony-theme') ?>
            </label>
        </th>
        <td>
            <input
                class="regular-text"
                id="input-google-analytics-id"
                name="google-analytics-id"
                type="text"
                value="<?= get_option('symfony-theme/general-settings/google-analytics-id') ?>"
            >
        </td>
    </tr>
</table>
