<?php

use Illuminate\Database\Seeder;

class DPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dps = [
            'the_shop' => [
                    'customer' => [
                        "Create table the_shop_customer(Cus_id varchar(4),Cus_name Varchar(30),Email varchar(20),Membership_Date Date,Primary key(Cus_id));",
                        ['C001', 'Jim Harper', 'jh@gmail.com', '2004-09-30'],
                        ['C002', 'Dwight Shrute', 'ds@gmail.com', '2003-08-30'],
                        ['C003', 'Pam Beesly', 'pm@yahoo.com', '2003-01-30'],
                        ['C004', 'Michael Scott', 'ms@yahoo.com', '1999-01-30'],
                        ['C005', 'Andrew Bernard','AB@gmail', '2005-12-30'],
                        ['C006', 'Angela Martin', 'am@gmail.com', '2004-07-30'],
                        ['C007', 'Phyllis Vance', 'pv@msn.com', '1999-06-30'],
                    ],
                    'product' => [
                        "Create table the_shop_product(Product_id  varchar(4),Product_name varchar(30),Price double,Primary key(Product_id));",
                        ['P001', 'Sunflower oil', 1200],
                        ['P002', 'Huggis diaper', 1500],
                        ['P003', 'kitkat', 100],
                        ['P004', 'Mark 3 Razor', 750],
                        ['P005', 'Vaseline lotion', 450],

                    ],
                    'orders' => [
                        "Create table the_shop_orders(Cus_id  varchar(4),Product_id  varchar(4),Quantity int,Order_date date,primary key (Cus_id, Product_id),foreign key (Cus_id) references the_shop_customer(Cus_id),foreign key (Product_id) references the_shop_product(Product_id));",
                        ['C001', 'P001', 1, '2005-09-30'],
                        ['C001', 'P003', 1, '2005-09-30'],
                        ['C005', 'P004', 1, '2005-10-30'],
                        ['C004', 'P003', 5, '2005-09-29'],
                        ['C003', 'P002', 2, '2004-09-30'],
                        ['C001', 'P002', 1, '2004-09-30'],
                        ['C004', 'P005', 2, '2005-09-29'],
                        ['C004', 'P001', 2, '2005-12-31'],
                        ['C002', 'P003', 8, '2006-09-30'],
                    ]
                ],
            
        ];
    }
}
