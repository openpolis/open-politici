<?php use_helper('Javascript') ?>

<?php echo image_tag('/images/admin_icons/button_ok.png', 
                      array ('alt' => 'Ok', 
                             'title' => 'Controllato' . 
                                        ($user_check->getOpUser()->getId() != $sf_user->getSubscriberId() ? ' da ' . $user_check->getOpUser() : '') . 
                                        ' il ' . $user_check->getCreatedAt('d/m/Y H:i'))) ?>
