<h2><?= __('Page without tabs', 'wordpress-theme') ?></h2>

<table class="form-table">
    <tbody>
        <tr>
            <th><label for="input-field"><?= __('Label', 'wordpress-theme') ?></label></th>
            <td>
                <input class="regular-text" id="input-field" name="field" type="text"><br>
                <p class="description"><?= __('Some description.', 'wordpress-theme') ?></p>
            </td>
        </tr>

        <tr>
            <th scope="row"><?= __('Checkbox', 'wordpress-theme') ?></th>
            <td>
                <label for="input-checkbox">
                    <input id="input-checkbox" name="checkbox" type="checkbox">
                    <?= __('The label for the checkbox', 'wordpress-theme') ?>
                </label>
            </td>
        </tr>

        <tr>
            <th><label for="input-dropdown"><?= __('Dropdown', 'wordpress-theme') ?></label></th>
            <td>
                <select id="input-dropdown" name="dropdown">
                    <option><?= __('Option x', 'wordpress-theme') ?></option>
                    <option><?= __('Option y', 'wordpress-theme') ?></option>
                </select>
            </td>
        </tr>
    </tbody>
</table>
