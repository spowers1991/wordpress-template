<div class="wrap">
    <h1>Manage My Plugins</h1>
    <form method="post" action="options.php">
        <?php
        // Output nonce, action, and option page fields for the settings form.
        settings_fields('my_plugins_settings_group');

        // Output setting sections and their fields.
        do_settings_sections('my-plugins-settings');

        // Output save settings button.
        submit_button();
        ?>

        <h2>Sub Plugins Activation</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Filters Plugin</th>
                <td>
                    <input type="checkbox" name="filters_plugin_active" value="1" <?php checked(1, get_option('filters_plugin_active', 0)); ?> />
                    <label for="filters_plugin_active">Activate Filter Plugin</label>
                </td>
            </tr>
        </table>
    </form>
</div>
