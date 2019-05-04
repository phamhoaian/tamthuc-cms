<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <li class="nav-item start <?php echo !empty($active_menu) && $active_menu == "dashboard" ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/dashboards'); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Tổng quan</span>
                </a>
            </li>
            <?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("feature_list", "feature_edit")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/features'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Nét đặc sắc</span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("feature_list", "feature_edit")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "feature_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/features'); ?>" class="nav-link ">
                            <i class="icon-list"></i>&nbsp;
                            <span class="title">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "feature_edit" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/features/edit'); ?>" class="nav-link ">
                            <i class="icon-plus"></i>&nbsp;
                            <span class="title">Thêm mới</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("introduction_list", "introduction_edit")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/introductions'); ?>" class="nav-link nav-toggle">
                    <i class="icon-energy"></i>
                    <span class="title">Giới thiệu</span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("introduction_list", "introduction_edit")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "introduction_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/introductions'); ?>" class="nav-link ">
                            <i class="icon-list"></i>&nbsp;
                            <span class="title">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "introduction_edit" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/introductions/edit'); ?>" class="nav-link ">
                            <i class="icon-plus"></i>&nbsp;
                            <span class="title">Thêm mới</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("menu_list", "menu_edit")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/menus'); ?>" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Thực đơn</span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("menu_list", "menu_edit")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "menu_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/menus'); ?>" class="nav-link ">
                            <i class="icon-list"></i>&nbsp;
                            <span class="title">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "menu_edit" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/menus/edit'); ?>" class="nav-link ">
                            <i class="icon-plus"></i>&nbsp;
                            <span class="title">Thêm mới</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("promotion_list", "promotion_edit")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/promotions'); ?>" class="nav-link nav-toggle">
                    <i class="icon-present"></i>
                    <span class="title">Khuyến mãi</span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("promotion_list", "promotion_edit")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "promotion_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/promotions'); ?>" class="nav-link ">
                            <i class="icon-list"></i>&nbsp;
                            <span class="title">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "promotion_edit" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/promotions/edit'); ?>" class="nav-link ">
                            <i class="icon-plus"></i>&nbsp;
                            <span class="title">Thêm mới</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("news_categories", "news_list", "gallery_list")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/news'); ?>" class="nav-link nav-toggle">
                    <i class="icon-book-open"></i>
                    <span class="title">Tin tức</span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("news_categories", "news_list", "news_image")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "news_categories" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/news/categories'); ?>" class="nav-link ">
                            <i class="icon-organization"></i>&nbsp;
                            <span class="title">Thể loại</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "news_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/news'); ?>" class="nav-link ">
                            <i class="icon-list"></i>&nbsp;
                            <span class="title">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "gallery_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/galleries'); ?>" class="nav-link ">
                            <i class="icon-picture"></i>&nbsp;
                            <span class="title">Hình ảnh</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("vip_member_policy", "vip_member_request")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/vip-member'); ?>" class="nav-link nav-toggle">
                    <i class="icon-star"></i>
                    <span class="title">
                        Thành viên VIP
                        <?php if (isset($count_uncheck_request) && $count_uncheck_request > 0) : ?>
                        <span class="badge badge-danger"><?php echo $count_uncheck_request; ?></span>
                        <?php endif; ?>
                    </span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("vip_member_policy", "vip_member_request")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "vip_member_policy" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/vip-member/policy'); ?>" class="nav-link ">
                            <i class="icon-book-open"></i>&nbsp;
                            <span class="title">Chính sách thành viên</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "vip_member_request" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/vip-member/request'); ?>" class="nav-link ">
                            <i class="icon-energy"></i>&nbsp;
                            <span class="title">Yêu cầu xem điểm
                                <?php if (isset($count_uncheck_request) && $count_uncheck_request > 0) : ?>
                                <span class="badge badge-danger"><?php echo $count_uncheck_request; ?></span>
                                <?php endif; ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("contact_agency", "contact_list")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/contact'); ?>" class="nav-link nav-toggle">
                    <i class="icon-call-in"></i>
                    <span class="title">
                        Liên hệ
                        <?php if (isset($count_uncheck_contact) && $count_uncheck_contact > 0) : ?>
                        <span class="badge badge-danger"><?php echo $count_uncheck_contact; ?></span>
                        <?php endif; ?>
                    </span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("contact_agency", "contact_list")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "contact_agency" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/contact/agency'); ?>" class="nav-link ">
                            <i class="icon-location-pin"></i>&nbsp;
                            <span class="title">Chi nhánh</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $active_menu == "contact_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/contact'); ?>" class="nav-link ">
                            <i class="icon-phone"></i>&nbsp;
                            <span class="title">Liên hệ
                                <?php if (isset($count_uncheck_contact) && $count_uncheck_contact > 0) : ?>
                                <span class="badge badge-danger"><?php echo $count_uncheck_contact; ?></span>
                                <?php endif; ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <li class="nav-item <?php echo !empty($active_menu) && $active_menu == "order_table" ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/orders'); ?>" class="nav-link nav-toggle">
                    <i class="icon-event"></i>
                    <span class="title">
                        Đặt bàn
                        <?php if (isset($count_uncheck_order) && $count_uncheck_order > 0) : ?>
                        <span class="badge badge-danger"><?php echo $count_uncheck_order; ?></span>
                        <?php endif; ?>
                    </span>
                </a>
            </li>
            <?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
            <li class="nav-item <?php echo !empty($active_menu) && $active_menu == "recruitment" ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/recruitments'); ?>" class="nav-link nav-toggle">
                    <i class="icon-people"></i>
                    <span class="title">Tuyển dụng</span>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-item <?php echo !empty($active_menu) && in_array($active_menu, array("event_list", "event_edit")) ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/event'); ?>" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">Sự kiện</span>
                    <span class="arrow <?php echo !empty($active_menu) && in_array($active_menu, array("event_list", "event_edit")) ? "open" : "" ?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo $active_menu == "event_list" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/events'); ?>" class="nav-link ">
                            <i class="icon-list"></i>&nbsp;
                            <span class="title">Danh sách</span>
                        </a>
                    </li>
                    <?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
                    <li class="nav-item <?php echo $active_menu == "event_edit" ? "active" : "" ?>">
                        <a href="<?php echo $this->Html->url('/admin/events/edit'); ?>" class="nav-link ">
                            <i class="icon-plus"></i>&nbsp;
                            <span class="title">Thêm mới</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
            <li class="nav-item <?php echo !empty($active_menu) && $active_menu == "setting" ? "active" : "" ?>">
                <a href="<?php echo $this->Html->url('/admin/settings'); ?>" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Thiết lập</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->