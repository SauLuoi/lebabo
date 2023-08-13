<?php
/* Template Name: Đăng nhập - Đăng ký */
?>
<?php get_header(); ?>
<main id="site-content">
    <div class="section-inner">
        <div class="content">
            <div class="content-register">
                <h2 class="title">Người dùng mới</h2>
                <?php
                global $err;
                $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
                $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
                $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
                $user_pass = isset($_POST['user_pass']) ? $_POST['user_pass'] : '';


                $userdata = array(
                    'first_name' => $first_name,
                    'user_login' => $user_email,
                    'show_admin_bar_front' => false,
                    'last_name' => $last_name,
                    'user_email' => $user_email,
                    'user_pass' => $user_pass // When creating an user, `user_pass` is expected.
                );
                wp_insert_user($userdata);
                $user_id = wp_insert_user($userdata);
                if (!is_wp_error($user_id)) {
                    echo "User created : " . $user_id;
                } else {
                    $error_code = array_key_first($user_id->errors);
                    $error_message = $user_id->errors[$error_code][0];

                    echo $error_code;

                    if ($error_code === 'existing_user_login') {
                        $err = 'Đã tồn tại email';
                    } else {
                        echo 'đăng ký thành công';
                    }
                }
                ?>
                <?php if ($err) { ?>
                    <span class="error-text"><?php echo $err; ?></span>
                <?php } ?>
                <form action="" method="post">
                    <form-group>
                        <label for="first_name">Họ</label>
                        <input type="text" name="first_name">
                    </form-group>
                    <form-group>
                        <label for="last_name">Tên</label>
                        <input type="text" name="last_name">
                    </form-group>
                    <form-group>
                        <label for="user_email">Email</label>
                        <input type="email" name="user_email">
                    </form-group>
                    <form-group>
                        <label for="user_pass">Password</label>
                        <input type="password" name="user_pass">
                    </form-group>
                    <div class="action">
                        <input type="submit" value="đăng ký">
                        <div class="checkbox">
                            <div class="checkbox-item">
                                <input type="checkbox" id="checkbox-accept-terms" required
                                       name="checkbox-accept-terms">
                                <label for="checkbox-accept-terms" class="privacy-policy">
                                    I agree to the Le Labo
                                    <a href="/terms-and-conditions.html" target="_blank"><strong>Terms and
                                            Conditions</strong></a>
                                    and
                                    <a href="/privacy-policy.html" target="_blank"><strong>Privacy
                                            Policy</strong></a>.
                                    By clicking “Register”, you agree to create an account with us. Your name and
                                    email address will be used for the purpose of maintaining your account. We
                                    cannot create an account for you without this information. For more information
                                    on Le Labo’s privacy practices, your rights and how to exercise these rights,
                                    and your relevant data controllers, please see our
                                    <a href="/privacy-policy.html" target="_blank"><strong>Privacy
                                            Policy</strong></a>.
                                </label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="checkbox-accept-register" name="checkbox-accept-terms">
                                <label for="checkbox-accept-register" class="privacy-policy">
                                    I agree to the Le Labo
                                    <a href="/terms-and-conditions.html" target="_blank"><strong>Terms and
                                            Conditions</strong></a>
                                    and
                                    <a href="/privacy-policy.html" target="_blank"><strong>Privacy
                                            Policy</strong></a>.
                                    By clicking “Register”, you agree to create an account with us. Your name and
                                    email address will be used for the purpose of maintaining your account. We
                                    cannot create an account for you without this information. For more information
                                    on Le Labo’s privacy practices, your rights and how to exercise these rights,
                                    and your relevant data controllers, please see our
                                    <a href="/privacy-policy.html" target="_blank"><strong>Privacy
                                            Policy</strong></a>.
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="content-login">
                <h2 class="title">Đăng nhập</h2>
                <?php
                $home_url = site_url($_SERVER['REQUEST_URI']);
                $args = array(
                    'label_username' => __('Email Address'),
                    'remember' => false,
                    'redirect' => $home_url,
                );
                wp_login_form($args);
                ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
