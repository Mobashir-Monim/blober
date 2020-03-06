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
                    "Create table the_shop_product(Product_id varchar(4),Product_name varchar(30),Price double,Primary key(Product_id));",
                    ['P001', 'Sunflower oil', 1200],
                    ['P002', 'Huggis diaper', 1500],
                    ['P003', 'kitkat', 100],
                    ['P004', 'Mark 3 Razor', 750],
                    ['P005', 'Vaseline lotion', 450],
    
                ],
                'orders' => [
                    "Create table the_shop_orders(Cus_id varchar(4),Product_id varchar(4),Quantity int,Order_date date,primary key (Cus_id, Product_id),foreign key (Cus_id) references the_shop_customer(Cus_id),foreign key (Product_id) references the_shop_product(Product_id));",
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
            'the_office' => [
                'employee' => [
                    "Create table the_office_employee(Emp_id varchar(4), Name varchar(30),Salary integer,Branch_location varchar(10),Joining_Date Date,Primary key(Emp_id));",
                    ['e001', 'Jim Harper', 60000, 'Scranton ',  '2004-09-30'],
                    ['e002', 'Dwight Shrute', 65000, 'Scranton ',  '2003-08-30'],
                    ['e003', 'Pam Beesly', 55000, 'New York ',  '2003-01-30'],
                    ['e004', 'Michael Scott', 80000, 'New York ',  '1990-01-30'],
                    ['e005', 'Andrew Bernard ', 50000, 'Stanford ',  '2005-12-30'],
                    ['e006',  'Angela Martin ', 70000, 'Scranton ',  '2004-07-30'],
                    ['e007',  'Phyllis Vance ', 60000, 'Stanford ',  '1990-06-30'],
    
                ],
                'client' => [
                    "Create table the_office_client(Client_id  varchar(4), Name varchar(30), Location Varchar(20), Contract_Date Date, Primary key(Client_id));",
                    ['c001', 'Mr. Deckert', 'Stanford',  '2004-10-30'],
                    ['c002', 'Dunmore High School', 'Scranton',  '1991-02-10'],
                    ['c003', 'Attorneys at Law', 'New York',  '2002-01-01'],
                    ['c004', 'Daniel Schofield', 'Scranton',  '2005-06-01'],
                    ['c005', 'Jan Levinson',  'New York',  '1999-07-15'],
    
                ],
                'sales' => [
                    "Create table the_office_sales(Emp_id varchar(4), Client_id varchar(4), Sale_Amount int, Last_Sale Date, Primary key(Emp_Id,Client_id), Foreign key(Emp_Id) references the_office_employee(Emp_id), Foreign key(Client_id) references the_office_client(Client_id));",
                    ['e001', 'c001', 1000, '2018-12-12'],
                    ['e001', 'c003', 10000, '2019-10-09'],
                    ['e002', 'c004', 20000, '2018-06-11'],
                    ['e004', 'c003', 6000, '2019-10-10'],
                    ['e003', 'c002', 8000, '2018-07-08'],
                    ['e005', 'c001', 1000, '2016-06-11'],
                    ['e004', 'c005', 10000, '2018-05-01'],
                    ['e007', 'c001', 4000, '2017-06-11'],
                    ['e002', 'c003', 1000, '2019-06-11'],
    
                ]
            ],
            'hero_management' => [
                'heroes' => [
                    "Create table hero_management_heroes(Hero_id varchar(3), Name Varchar(30), Location Varchar(20), Primary key(Hero_id));",
                    ['h01', 'The Flash', 'Central City'],
                    ['h02', 'Batman', 'Gotham'],
                    ['h03', 'Green Arrow', 'Star City'],
                    ['h04', 'Wonder Woman', 'Themyscira'],
                    ['h05', 'Green Lantern', 'Coast City'],
                    ['h06', 'Black Canary', 'Star City'],
                ],
                'villains' => [
                    "Create table hero_management_villains(Villain_id  varchar(3), Name varchar(30), Location Varchar(20), Primary key(Villain_id));",
                    ['v01', 'Reverse Flash', 'Central City'],
                    ['v02', 'Deathstroke', 'Star City'],
                    ['v03', 'Joker', 'Gotham'],
                    ['v04', 'Riddler', 'Gotham'],
                    ['v05', 'Harley Quinn', 'Gotham'],
                    ['v06', 'Ares', 'Mount Olympus'],
    
                ],
                'battles' => [
                    "Create table hero_management_battles(Hero_id varchar(3), Villain_id varchar(3), Date date, Hero_points int, Villain_points int, Battle_location varchar(20), Primary key(Hero_id, Villain_id, date), Foreign key(Hero_id) references hero_management_heroes(Hero_id), Foreign key(Villain_id) references hero_management_villains(Villain_id));",
                    ['h01', 'v01', '2017-12-12', 92, 85, 'Central City'],
                    ['h01', 'v06', '2016-09-10', 40, 98, 'Metropolis'],
                    ['h03', 'v02', '2018-11-06', 90, 93, 'Star City'],
                    ['h04', 'v06', '2016-10-10', 99, 98, 'Central City'],
                    ['h06', 'v05', '2018-08-07', 92, 85, 'Star City'],
                    ['h03', 'v02', '2017-11-06', 90, 88, 'Star City'],
                ]
            ],
            'hogwarts_db_project' => [
                'project_info' => [
                    "Create table hogwarts_db_project_project_info(Std_ID  char(4),Std_Name varchar(30),Section integer, Project_Title varchar(50), Score double, Submission_Date date);",
                    ['s001', 'Sirius Black', 2, 'Animagus Registration System', 31, '2017-09-20'],
                    ['s002', 'Fred Weasley', 2, 'Joke Shop Management', 26, '2017-09-30'],
                    ['s003', 'Hermione Granger', 1, 'Elf Rights Volunteer Management', 35, '2017-09-30'],
                    ['s004', 'Mad Eye Moody', 1, 'Crime Reporting System', 28, '2017-09-28'],
                    ['s005', 'Dolores Umbridge', 2, 'Pure Blood Registration System', 35, '2017-10-01'],
                ],
            ],
            'marvel' => [
                'hero_info' => [
                    "Create table marvel_hero_info(Hero_ID  char(4),Hero_Name varchar(30),Gender char(1), Special_Power varchar(30), Strength integer, Last_Fight date);",
                    ['s001', 'Spider Man', 'M', 'Climbing', 76, '2017-06-05'],
                    ['s002', 'Black Widow', 'F', 'Assassination', 70, '2017-05-31'],
                    ['s003', 'Hulk', 'M', 'Superhuman Physical Ability', 98, '2017-05-31'],
                    ['s004', 'Thor', 'M', 'Special Hammer', 88, '2017-06-06'],
                    ['s005', 'Captain Marvel', 'F', 'Throwing Energy Bursts', 85, '2017-06-08'],
                    ['s006', 'Ironman', 'M', 'Special Suit', 80, '2017-09-08'],
                    
                ]
            ],
            'justice_league' => [
                'hero_info' => [
                    "Create table justice_league_hero_info(Hero_ID  char(4),Hero_Name varchar(30),Gender char(1), Special_Power varchar(30), Strength integer, Last_Fight date);",
                    ['s001', 'Green Lantern', 'M', 'Power Ring', 90, '2017-05-31'],
                    ['s002', 'Wonder Woman', 'F', 'Superhuman Strength', 98, '2017-06-10'],
                    ['s003', 'Superman', 'M', 'Superhuman Physical Ability', 96, '2017-05-31'],
                    ['s004', 'Batman', 'M', 'Technology and martial arts', 94, '2017-06-06'],
                    ['s005', 'Hawkgirl', 'F', 'Flight and Strength', 80, '2017-06-08'],
                    ['s006', 'The Flash', 'M', 'Super Speed', 87, '2017-09-08'],
                ]
            ],
        ];
    
        foreach ($dps as $dp_name => $dp) {
            $pool = App\DataPool::create(['name' => $dp_name]);
    
            foreach ($dp as $table_name => $table) {
                $tb = App\Table::create(['name' => $dp_name . '_' . $table_name]);
                $pool->tables()->attach($tb->id);
    
                foreach ($table as $key => $row) {
                    if ($key == 0) {
                        \DB::statement($row);
                    } else {
                        $statement = "insert into $tb->name values (";
    
                        foreach ($row as $current => $col) {
                            if (gettype($col) == 'string') {
                                $statement .= "'" . $col . "'";
                            } else {
                                $statement .= $col;
                            }
    
                            if ($current == sizeof($row) - 1) {
                                $statement .= ');';
                            } else {
                                $statement .= ',';
                            }
                        }
    
                        \DB::statement($statement);
                    }
                }
            }
        }
    }
}
