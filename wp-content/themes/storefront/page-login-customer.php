<?php
/* Template Name: Đăng nhập */
?>
<?php get_header(); ?>

<div>
    <div class="login-new-client">
        <form action="" method='POST'>
            <div class="group">
                <label for="first_name" class="form-label">Họ</label>
                <div class="group-input">
                    <input type="text" id="first_name" name="first_name" class="field">
                </div>
            </div>
            <div class="group">
                <label for="last_name" class="form-label">Tên</label>
                <div class="group-input">
                    <input type="text" name="last_name" id="last_name" class="field">
                </div>
            </div>
            <div class="group">
                <label for="email" class="form-label">Email</label>
                <div class="group-input">
                    <input name="email" type="email" id="email" class="field">
                </div>
            </div>
            <div class="group">
                <label for="password" class="form-label">Mật khẩu</label>
                <div class="group-input">
                    <input type="password" name="password" id="password" class="field">
                </div>
            </div>
            <div class="group">
                <input type="submit" value="Submit" name="submit">
            </div>
        </form>
    </div>
</div>
<?php
function insertData()
{
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $err = '';
    $success = '';
    $data = array(
        'firstName' => $first,
        'lastName' => $last,
        'email' => $email,
        'password' => $password,
    );
    global $wpdb;
    $table = $wpdb->prefix . 'register_customer';
    $wpdb->insert(
        $table,
        $data
    );
    if (!$first) {
        $err = "thiếu họ";
    } elseif (!$last) {
        $err = "thiếu tên";
    } elseif (!$email) {
        $err = "thiếu email";
    } elseif (!$password) {
        $err = "thiếu mật khẩu";
    } else {
        $contact = $wpdb->insert_id;
        if ($contact) {
            $success = "Thêm dữ liệu thành công";
            header('Location: login ');
        } else {
            $err = "Đăng ký không thành công!";
        }
    }

    if ($err) {
        echo '<span class="notice-error">' . $err . '</span>';
    }
    if ($success) {
        echo '<span class="notice-success">' . $success . '</span>';
    }
}

if (isset($_POST['submit'])) {
    insertData();
}
?>

<?php get_footer(); ?>
