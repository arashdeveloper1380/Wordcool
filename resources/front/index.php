<?php ar_header() ?>
    <p style="text-align: center;">this is index page</p>
    <table id="table">
        <tr>
            <th>نام</th>
            <th>موبایل</th>
        </tr>
        <tbody>
            <?php foreach($samples as $value): ?>
                <tr>
                    <td><?= $value->name ?></td>
                    <td><?= $value->phone ?></td>
                </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>
    <?php errors(); ?>
    <?php
        if (getSession('success')) { ?>
            <h3><?= getSession('success') ?></h3>
       <?php }
    ?>
    <form action="<?= route('/save') ?>" name="save" method="post">

        <label for="name">First name:</label><br>
            <input type="text" id="name" name="name"><br>
        <label for="name">phone:</label><br>
            <input type="text" id="phone" name="phone"><br>
        <input type="submit" value="Submit">

    </form> 

<?php ar_footer() ?>