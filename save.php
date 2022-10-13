// Last name
if (empty($_POST['last_name'])) {
if (get_user_meta($user_id, 'last_name', true)) {
// Delete user meta last name
delete_user_meta($user_id, 'last_name', $_POST['last_name']);
}
//array_push($form_errors, "last_name");
} elseif (isset($_POST['last_name'])) {
if (!get_user_meta('last_name')) {
add_user_meta($user_id, 'last_name', $_POST['last_name']);
} else {
if ($_POST['last_name'] === get_user_meta($user_id, 'last_name', true)) {
//Do nothing it's the same
} else {
update_user_meta($user_id, 'last_name', $_POST['last_name']);
}
}
}

// custom_email
if (empty($_POST['custom_email'])) {
if (get_user_meta($user_id, 'custom_email', true)) {
// Delete user meta custom_email
delete_user_meta($user_id, 'custom_email', $_POST['custom_email']);
}

//array_push($form_errors, "custom_email");
} elseif (isset($_POST['custom_email'])) {
if (!get_user_meta('custom_email')) {
add_user_meta($user_id, 'custom_email', $_POST['last_name']);
} else {
if ($_POST['custom_email'] === get_user_meta($user_id,'custom_email', true)) {
//Do nothing it's the same
} else {
update_user_meta($user_id, 'custom_email', $_POST['custom_email']);
}
}
}