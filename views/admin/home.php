<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.custom_date').datepicker({
            dateFormat : 'yy-mm-dd'
        });
    });
</script>
<div class="wrap">
    <h1><?= __("WP SimpleContact") ?></h1>

    <div class="filters">
        <h2><?= __('Search', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></h2>
        <form method="post" action="">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="begin_date"><?= __('Begin date', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></label>
                        </th>
                        <td>
                            <input type="text" class="custom_date" id="begin_date" name="begin_date"
                                   value="<?= $beginDateValue ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="end_date"><?= __('End date', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></label>
                        </th>
                        <td>
                            <input type="text" class="custom_date" id="end_date" name="end_date"
                                   value="<?= $endDateValue ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="email"><?= __('Email', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></label>
                        </th>
                        <td>
                            <input type="email" id="email" name="email" value="<?= $emailValue ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="message"><?= __('Message', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></label>
                        </th>
                        <td>
                            <input type="text" id="message" name="message" value="<?= $messageValue ?>" />
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(__('Search', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN)); ?>
        </form>
    </div>
    <?php if (!empty($messages)) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?= __('Date', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></th>
                    <th><?= __('Email', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></th>
                    <th><?= __('Subject', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></th>
                    <th><?= __('Message', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($messages as $message) : ?>
                <tr>
                    <td><?= $message['date']; ?></td>
                    <td><?= $message['email']; ?></td>
                    <td><?= stripcslashes($message['subject']); ?></td>
                    <td><?= stripcslashes($message['message']); ?></td>
                </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>
