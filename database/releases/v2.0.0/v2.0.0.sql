create table `currencies` (`id` bigint unsigned not null auto_increment primary key, `currency_name` varchar(255) not null, `currency_icon` varchar(255) not null, `currency_code` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

create table `subscription_plans` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `currency_id` bigint unsigned not null, `price` double(8, 2) not null, `plan_type` int not null, `valid_until` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `subscription_plans` add constraint `subscription_plans_currency_id_foreign` foreign key (`currency_id`) references `currencies` (`id`);

create table `v_cards` (`id` bigint unsigned not null auto_increment primary key, `template_id` int not null, `v_card_name` varchar(20) not null, `name` varchar(30) not null, `occupation` varchar(30) not null, `introduction` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null, `tenant_id` varchar(255) not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `v_cards` add constraint `v_cards_tenant_id_foreign` foreign key (`tenant_id`) references `tenants` (`id`) on delete cascade on update cascade;

create table `v_card_attributes` (`id` bigint unsigned not null auto_increment primary key, `v_card_id` bigint unsigned null, `icon` varchar(255) null, `icon_color` varchar(255) null, `label_text` varchar(255) null, `value_text` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `v_card_attributes` add constraint `v_card_attributes_v_card_id_foreign` foreign key (`v_card_id`) references `v_cards` (`id`) on delete cascade on update cascade;

alter table `v_cards` add `v_card_unique_id` varchar(20) not null after `id`;

alter table `v_cards` add unique `v_cards_v_card_unique_id_unique`(`v_card_unique_id`);

create table `subscriptions` (`id` bigint unsigned not null auto_increment primary key, `user_id` int unsigned not null, `stripe_id` varchar(255) null, `stripe_status` varchar(255) null, `stripe_plan` varchar(255) null, `subscription_plan_id` bigint unsigned null, `start_date` datetime null, `end_date` datetime null, `status` tinyint(1) not null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `subscriptions` add index `subscriptions_user_id_stripe_status_index`(`user_id`, `stripe_status`);

alter table `subscriptions` add constraint `subscriptions_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE;

alter table `subscriptions` add constraint `subscriptions_subscription_plan_id_foreign` foreign key (`subscription_plan_id`) references `subscription_plans` (`id`) on delete CASCADE on update CASCADE;

alter table `subscriptions` add `payment_intend_id` varchar(255) null after `subscription_plan_id`;
