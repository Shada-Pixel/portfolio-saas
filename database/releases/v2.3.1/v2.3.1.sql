alter table `users` add `project` int null after `available_as_freelancer`, add `support` varchar(255) null after `project`;
alter table `subscriptions` drop `stripe_id`;
alter table `subscriptions` drop `stripe_status`;
alter table `subscriptions` drop `stripe_plan`;
alter table `subscriptions` drop `payment_intend_id`;
alter table `subscriptions` add `transaction_id` varchar(255) null after `subscription_plan_id`, add `type` int null comment '1: Stripe, 2: Paypal' after `transaction_id`, add `amount` double(8, 2) null after `type`, add `meta` json null after `amount`;
alter table `subscriptions` add index `subscriptions_transaction_id_index`(`transaction_id`);
