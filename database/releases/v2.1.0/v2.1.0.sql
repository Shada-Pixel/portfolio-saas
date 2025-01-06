create table `favorite_portfolios` (`id` bigint unsigned not null auto_increment primary key, `follower_id` int unsigned not null, `following_id` int unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `favorite_portfolios` add constraint `favorite_portfolios_follower_id_foreign` foreign key (`follower_id`) references `users` (`id`) on delete cascade on update cascade;

alter table `favorite_portfolios` add constraint `favorite_portfolios_following_id_foreign` foreign key (`following_id`) references `users` (`id`) on delete cascade on update cascade;
