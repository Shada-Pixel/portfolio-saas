create table `qr_codes` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `url` varchar(255) not null, `color` varchar(255) null, `size` varchar(255) null, `white_space` varchar(255) null, `style` varchar(255) null, `eye_style` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `tenant_id` varchar(255) not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `qr_codes` add constraint `qr_codes_tenant_id_foreign` foreign key (`tenant_id`) references `tenants` (`id`) on delete cascade on update cascade;
