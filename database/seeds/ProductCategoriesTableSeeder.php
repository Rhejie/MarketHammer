<?php

use Illuminate\Database\Seeder;
use App\Model\ProductCategories;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProductCategories::truncate();
        //\DB::table('product_categories')->delete();

        $productCategories = [
            [
                'attributes' => [
                    'name' => 'Agriculture & Food',
                ],
                'children' => [
                    [
                        'attributes' => [
                            'name' => 'Agriculture',
                        ],
                        'children' => [
                            [ 'name' => 'Agricultural Waste' ],
                            [ 'name' => 'Animal Products'],
                            [ 'name' => 'Beans'],
                            [ 'name' => 'Cocoa Beans'],
                            [ 'name' => 'Coffee Beans'],
                            [ 'name' => 'Farm Machinery & Equipment'],
                            [ 'name' => 'Feed'],
                            [ 'name' => 'Fresh Seafood'],
                            [ 'name' => 'Fruit'],
                            [ 'name' => 'Grain'],
                            [ 'name' => 'Herbal Cigars & Cigarettes'],
                            [ 'name' => 'Mushrooms & Truffles'],
                            [ 'name' => 'Nuts & Kernels'],
                            [ 'name' => 'Ornamental Plants'],
                            [ 'name' => 'Other Agriculture Products'],
                            [ 'name' => 'Plant & Animal Oil'],
                            [ 'name' => 'Plant Seeds & Bulbs'],
                            [ 'name' => 'Timber Raw Materials'],
                            [ 'name' => 'Vanilla Beans'],
                            [ 'name' => 'Vegetables'],
                        ]
                    ],
                    [
                        'attributes' => [
                            'name' => 'Food & Beverage'
                        ],
                        'children' => [
                            [ 'name' => 'Alcoholic Beverage'],
                            [ 'name' => 'Baby Food'],
                            [ 'name' => 'Baked Goods'],
                            [ 'name' => 'Bean Products'],
                            [ 'name' => 'Canned Food'],
                            [ 'name' => 'Coffee'],
                            [ 'name' => 'Confectionery'],
                            [ 'name' => 'Dairy'],
                            [ 'name' => 'Drinking Water'],
                            [ 'name' => 'Egg & Egg Products'],
                            [ 'name' => 'Food Ingredients'],
                            [ 'name' => 'Fruit Products'],
                            [ 'name' => 'Grain Products'],
                            [ 'name' => 'Honey Products'],
                            [ 'name' => 'Instant Food'],
                            [ 'name' => 'Meat & Poultry'],
                            [ 'name' => 'Other Food & Beverage'],
                            [ 'name' => 'Seafood'],
                            [ 'name' => 'Seasonings & Condiments'],
                            [ 'name' => 'Snack Food'],
                            [ 'name' => 'Soft Drinks'],
                            [ 'name' => 'Tea'],
                            [ 'name' => 'Vegetable Products'],
                        ]
                    ]
                ]
                
            ],
            [
                'attributes' => [
                    'name' => 'Apparel,Textiles & Accessories',
                ],
                'children' => [
                    [
                        'attributes' => [
                            'name' => 'Apparel',
                        ],
                        'children' => [
                            [ 'name' => 'Apparel Design Services' ],
                            [ 'name' => 'Apparel Processing Services' ],
                            [ 'name' => 'Apparel Stock' ],
                            [ 'name' => 'Boy\'s Clothing' ],
                            [ 'name' => 'Costumes' ],
                            [ 'name' => 'Ethnic Clothing' ],
                            [ 'name' => 'Garment Accessories' ],
                            [ 'name' => 'Girl\'s Clothing' ],
                            [ 'name' => 'Infant & Toddlers Clothing' ],
                            [ 'name' => 'Mannequins' ],
                            [ 'name' => 'Maternity Clothing' ],
                            [ 'name' => 'Men\'s Clothing' ],
                            [ 'name' => 'Sewing Supplies' ],
                            [ 'name' => 'Sportswear' ],
                            [ 'name' => 'Stage & Dance Wear' ],
                            [ 'name' => 'Tag Guns' ],
                            [ 'name' => 'Uniforms' ],
                            [ 'name' => 'Used Clothes' ],
                            [ 'name' => 'Wedding Apparel & Accessories' ],
                            [ 'name' => 'Women\'s Clothing' ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'name' => 'Textile & Leather Product',
                        ],
                        'children' => [
                            [ 'name' => 'Down & Feather' ],
                            [ 'name' => 'Fabric' ],
                            [ 'name' => 'Fiber' ],
                            [ 'name' => 'Fur' ],
                            [ 'name' => 'Grey Fabric' ],
                            [ 'name' => 'Home Textile' ],
                            [ 'name' => 'Leather' ],
                            [ 'name' => 'Leather Product' ],
                            [ 'name' => 'Other Textiles & Leather Products' ],
                            [ 'name' => 'Textile Accessories' ],
                            [ 'name' => 'Textile Processing' ],
                            [ 'name' => 'Thread' ],
                            [ 'name' => 'Yarn' ],
                            [ 'name' => '100% Cotton Fabric' ],
                            [ 'name' => '100% Polyester Fabric' ],
                            [ 'name' => 'Bedding Set' ],
                            [ 'name' => 'Towel' ],
                            [ 'name' => 'Chair Cover' ],
                            [ 'name' => 'Genuine Leather' ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'name' => 'Fashion Accessories',
                        ],
                        'children' => [
                            [ 'name' => 'Belt Accessories' ],
                            [ 'name' => 'Belts' ],
                            [ 'name' => 'Fashion Accessories Design Services' ],
                            [ 'name' => 'Fashion Accessories Processing Services' ],
                            [ 'name' => 'Gloves & Mittens' ],
                            [ 'name' => 'Scarf, Hat & Glove Sets' ],
                            [ 'name' => 'Hats & Caps' ],
                            [ 'name' => 'Scarves & Shawls' ],
                            [ 'name' => 'Hair Accessories' ],
                            [ 'name' => 'Genuine Leather Belts' ],
                            [ 'name' => 'Leather Gloves & Mittens' ],
                            [ 'name' => 'Ties & Accessories' ],
                            [ 'name' => 'Belt Buckles' ],
                            [ 'name' => 'PU Belts' ],
                            [ 'name' => 'Belt Chains' ],
                            [ 'name' => 'Metal Belts' ],
                            [ 'name' => 'Suspenders' ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'name' => 'Timepieces, Jewelry, Eyewear',
                        ],
                        'children' => [
                            [ 'name' => 'Eyewear' ],
                            [ 'name' => 'Jewelry' ],
                            [ 'name' => 'Watches' ],
                            [ 'name' => 'Eyeglasses Frames' ],
                            [ 'name' => 'Sunglasses' ],
                            [ 'name' => 'Sports Eyewear' ],
                            [ 'name' => 'Body Jewelry' ],
                            [ 'name' => 'Bracelets & Bangles' ],
                            [ 'name' => 'Brooches' ],
                            [ 'name' => 'Cuff Links & Tie Clips' ],
                            [ 'name' => 'Earrings' ],
                            [ 'name' => 'Jewelry Boxes' ],
                            [ 'name' => 'Jewelry Sets' ],
                            [ 'name' => 'Jewelry Tools & Equipment' ],
                            [ 'name' => 'Loose Beads' ],
                            [ 'name' => 'Loose Gemstone' ],
                            [ 'name' => 'Necklaces' ],
                            [ 'name' => 'Pendants & Charms' ],
                            [ 'name' => 'Rings' ],
                            [ 'name' => 'Wristwatches' ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Auto & Transportation",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Vehicles & Accessories",
                        ],
                        "children" => [
                            [ "name" => "Automobiles" ],
                            [ "name" => "Trailers" ],
                            [ "name" => "Trucks" ],
                            [ "name" => "Golf Carts" ],
                            [ "name" => "Marine Parts & Accessories" ],
                            [ "name" => "Truck Parts & Accessories" ],
                            [ "name" => "Trains" ],
                            [ "name" => "Motorcycles & Scooters" ],
                            [ "name" => "Auto Parts & Accessories" ],
                            [ "name" => "Emergency Vehicles" ],
                            [ "name" => "Bus Parts & Accessories" ],
                            [ "name" => "ATVs & UTVs" ],
                            [ "name" => "Bus" ],
                            [ "name" => "Containers" ],
                            [ "name" => "Other Vehicle Parts & Accessories" ],
                            [ "name" => "Other Vehicles" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Bags, Shoes & Accessories",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Luggage, Bags & Cases",
                        ],
                        "children" => [
                            [ "name" => "Backpacks" ],
                            [ "name" => "Bag & Luggage Making Materials" ],
                            [ "name" => "Bag Parts & Accessories" ],
                            [ "name" => "Briefcases" ],
                            [ "name" => "Business Bags & Cases" ],
                            [ "name" => "Carry-on Luggage" ],
                            [ "name" => "Cosmetic Bags & Cases" ],
                            [ "name" => "Digital Gear & Camera Bags" ],
                            [ "name" => "Handbags" ],
                            [ "name" => "Handbags & Messenger Bags" ],
                            [ "name" => "Luggage & Travel Bags" ],
                            [ "name" => "Luggage Cart" ],
                            [ "name" => "Luggage Sets" ],
                            [ "name" => "Other Luggage, Bags & Cases" ],
                            [ "name" => "Shopping Bags" ],
                            [ "name" => "Special Purpose Bags & Cases" ],
                            [ "name" => "Sports & Leisure Bags" ],
                            [ "name" => "Trolley Bags" ],
                            [ "name" => "Wallets & Holders" ],
                            [ "name" => "Wallets" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Shoes & Accessories",
                        ],
                        "children" => [
                            [ "name" => "Baby Shoes" ],
                            [ "name" => "Children's Shoes" ],
                            [ "name" => "Dance Shoes" ],
                            [ "name" => "Genuine Leather Shoes" ],
                            [ "name" => "Men's Shoes" ],
                            [ "name" => "Other Shoes" ],
                            [ "name" => "Shoe Materials" ],
                            [ "name" => "Shoe Parts & Accessories" ],
                            [ "name" => "Shoe Repairing Equipment" ],
                            [ "name" => "Shoes Design Services" ],
                            [ "name" => "Shoes Processing Services" ],
                            [ "name" => "Shoes Stock" ],
                            [ "name" => "Special Purpose Shoes" ],
                            [ "name" => "Sports Shoes" ],
                            [ "name" => "Used Shoes" ],
                            [ "name" => "Women's Shoes" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Electronics",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Consumer Electronic",
                        ],
                        "children" => [
                            [ "name" => "3D Glasses" ],
                            [ "name" => "Accessories & Parts" ],
                            [ "name" => "Cables" ],
                            [ "name" => "Camera, Photo & Accessories" ],
                            [ "name" => "Charger" ],
                            [ "name" => "Computer Hardware & Software" ],
                            [ "name" => "Digital Battery" ],
                            [ "name" => "Digital Camera" ],
                            [ "name" => "Digital Photo Frame" ],
                            [ "name" => "Earphone & Headphone" ],
                            [ "name" => "Electronic Cigarettes" ],
                            [ "name" => "Electronic Publications" ],
                            [ "name" => "Home Audio, Video & Accessories" ],
                            [ "name" => "Mobile Phones" ],
                            [ "name" => "Mobile Phone & Accessories" ],
                            [ "name" => "Other Consumer Electronics" ],
                            [ "name" => "Portable Audio, Video & Accessories" ],
                            [ "name" => "Power Banks" ],
                            [ "name" => "Radio & TV Accessories" ],
                            [ "name" => "Speaker" ],
                            [ "name" => "Television" ],
                            [ "name" => "Video Game & Accessories" ]
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Home Appliance",
                        ],
                        "children" => [
                            [ "name" => "Air Conditioners" ],
                            [ "name" => "Air Conditioning Appliances" ],
                            [ "name" => "Blenders" ],
                            [ "name" => "Cleaning Appliances" ],
                            [ "name" => "Coffee Makers" ],
                            [ "name" => "Cooking Appliances" ],
                            [ "name" => "Fans" ],
                            [ "name" => "Hand Dryers" ],
                            [ "name" => "Home Appliance Parts" ],
                            [ "name" => "Home Appliances Stocks" ],
                            [ "name" => "Home Heaters" ],
                            [ "name" => "Kitchen Appliances" ],
                            [ "name" => "Laundry Appliances" ],
                            [ "name" => "Other Home Appliances" ],
                            [ "name" => "Refrigerators & Freezers" ],
                            [ "name" => "Solar Water Heaters" ],
                            [ "name" => "Water Heaters" ],
                            [ "name" => "Water Treatment Appliances" ],
                            [ "name" => "Wet Towel Dispensers" ],
                            [ "name" => "Vacuum Cleaners" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Security & Protection",
                        ],
                        "children" => [
                            [ "name" => "Alcohol Tester" ],
                            [ "name" => "Access Control Systems & Products" ],
                            [ "name" => "Alarm" ],
                            [ "name" => "Bullet Proof Vest" ],
                            [ "name" => "CCTV Camera" ],
                            [ "name" => "CCTV Products" ],
                            [ "name" => "Fire Alarm" ],
                            [ "name" => "Firefighting Supplies" ],
                            [ "name" => "Locks & Keys" ],
                            [ "name" => "Locksmith Supplies" ],
                            [ "name" => "Other Security & Protection Products" ],
                            [ "name" => "Personal Protective Equipment" ],
                            [ "name" => "Police & Military Supplies" ],
                            [ "name" => "Roadway Safety" ],
                            [ "name" => "Safes" ],
                            [ "name" => "Security Services" ],
                            [ "name" => "Self Defense Supplies" ],
                            [ "name" => "Water Safety Products" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Electrical Equipment, Components & Telecoms",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Electrical Equipment & Supplies",
                        ],
                                              
                        "children" => [
                            [ "name" => "Batteries" ],
                            [ "name" => "Circuit Breakers" ],
                            [ "name" => "Connectors & Terminals" ],
                            [ "name" => "Contactors" ],
                            [ "name" => "Electrical Instruments" ],
                            [ "name" => "Electronic & Instrument Enclosures" ],
                            [ "name" => "Electrical Supplies" ],
                            [ "name" => "Industrial Controls" ],
                            [ "name" => "Fuse Components" ],
                            [ "name" => "Fuses" ],
                            [ "name" => "Generators" ],
                            [ "name" => "Motors" ],
                            [ "name" => "Power Accessories" ],
                            [ "name" => "Power Distribution Equipment" ],
                            [ "name" => "Power Supplies" ],
                            [ "name" => "Professional Audio, Video & Lighting" ],
                            [ "name" => "Relays" ],
                            [ "name" => "Solar Cells, Solar Panel" ],
                            [ "name" => "Solar Energy Products" ],
                            [ "name" => "Switches" ],
                            [ "name" => "Transformers" ],
                            [ "name" => "Wires, Cables & Cable Assemblies" ],
                            [ "name" => "Wiring Accessories" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Gifts, Sports & Toys",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Sports & Entertainment",
                        ],
                                           
                        "children" => [
                            [ "name" => "Amusement Park" ],
                            [ "name" => "Artificial Grass & Sports Flooring" ],
                            [ "name" => "Camping & Hiking" ],
                            [ "name" => "Fitness & Body Building" ],
                            [ "name" => "Gambling" ],
                            [ "name" => "Golf" ],
                            [ "name" => "Gym Equipment" ],
                            [ "name" => "Indoor Sports" ],
                            [ "name" => "Musical Instruments" ],
                            [ "name" => "Other Sports & Entertainment Products" ],
                            [ "name" => "Outdoor Sports" ],
                            [ "name" => "Sports Gloves" ],
                            [ "name" => "Sports Safety" ],
                            [ "name" => "Sports Souvenirs" ],
                            [ "name" => "Team Sports" ],
                            [ "name" => "Tennis" ],
                            [ "name" => "Water Sports" ],
                            [ "name" => "Winter Sports" ],
                            [ "name" => "Scooters" ],
                            [ "name" => "Swimming & Diving" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Gifts & Crafts",
                        ],
                                           
                        "children" => [
                            [ "name" => "Art & Collectible" ],
                            [ "name" => "Crafts" ],
                            [ "name" => "Arts & Crafts Stocks" ],
                            [ "name" => "Cross Stitch" ],
                            [ "name" => "Festive & Party Supplies" ],
                            [ "name" => "Flags, Banners & Accessories" ],
                            [ "name" => "Gift Sets" ],
                            [ "name" => "Holiday Gifts" ],
                            [ "name" => "Home Decoration" ],
                            [ "name" => "Key Chains" ],
                            [ "name" => "Knitting & Crocheting" ],
                            [ "name" => "Lacquerware" ],
                            [ "name" => "Lanyard" ],
                            [ "name" => "Money Boxes" ],
                            [ "name" => "Music Boxes" ],
                            [ "name" => "Pottery & Enamel" ],
                            [ "name" => "Sculptures" ],
                            [ "name" => "Souvenirs" ],
                            [ "name" => "Stickers" ],
                            [ "name" => "Wedding Decorations & Gifts" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Toys & Hobbies",
                        ],
                        "children" => [
                            [ "name" => "Action Figure" ],
                            [ "name" => "Baby Toys" ],
                            [ "name" => "Balloons" ],
                            [ "name" => "Candy Toys" ],
                            [ "name" => "Classic Toys" ],
                            [ "name" => "Dolls" ],
                            [ "name" => "Educational Toys" ],
                            [ "name" => "Electronic Toys" ],
                            [ "name" => "Glass Marbles" ],
                            [ "name" => "Inflatable Toys" ],
                            [ "name" => "Light-Up Toys" ],
                            [ "name" => "Noise Maker" ],
                            [ "name" => "Other Toys & Hobbies" ],
                            [ "name" => "Outdoor Toys & Structures" ],
                            [ "name" => "Plastic Toys" ],
                            [ "name" => "Pretend Play & Preschool" ],
                            [ "name" => "Solar Toys" ],
                            [ "name" => "Toy Accessories" ],
                            [ "name" => "Toy Animal" ],
                            [ "name" => "Toy Guns" ],
                            [ "name" => "Toy Parts" ],
                            [ "name" => "Toy Robots" ],
                            [ "name" => "Toy Vehicle" ],
                            [ "name" => "Wind Up Toys" ],
                            [ "name" => "Wooden Toys" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Health & Beauty",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Health & Medical",
                        ],
                                               
                        "children" => [
                            [ "name" => "Animal Extract" ],
                            [ "name" => "Plant Extracts" ],
                            [ "name" => "Body Weight" ],
                            [ "name" => "Health Care Supplement" ],
                            [ "name" => "Health Care Supplies" ],
                            [ "name" => "Crude Medicine" ],
                            [ "name" => "Prepared Drugs In Pieces" ],
                            [ "name" => "Traditional Patented Medicines" ],
                            [ "name" => "Body Fluid-Processing & Circulation Devices" ],
                            [ "name" => "Clinical Analytical Instruments" ],
                            [ "name" => "Dental Equipment" ],
                            [ "name" => "Emergency & Clinics Apparatuses" ],
                            [ "name" => "Equipments of Traditional Chinese Medicine" ],
                            [ "name" => "General Assay & Diagnostic Apparatuses" ],
                            [ "name" => "Medical Consumable" ],
                            [ "name" => "Medical Cryogenic Equipments" ],
                            [ "name" => "Medical Software" ],
                            [ "name" => "Physical Therapy Equipments" ],
                            [ "name" => "Radiology Equipment & Accessories" ],
                            [ "name" => "Sterilization Equipments" ],
                            [ "name" => "Surgical Instrument" ],
                            [ "name" => "Ultrasonic, Optical, Electronic Equipment" ],
                            [ "name" => "Ward Nursing Equipments" ],
                            [ "name" => "Medicines" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Beauty & Personal Care",
                        ],
                        "children" => [
                            [ "name" => "Baby Care" ],
                            [ "name" => "Bath Supplies" ],
                            [ "name" => "Beauty Equipment" ],
                            [ "name" => "Body Art" ],
                            [ "name" => "Breast Care" ],
                            [ "name" => "Feminine Hygiene" ],
                            [ "name" => "Fragrance & Deodorant" ],
                            [ "name" => "Hair Care" ],
                            [ "name" => "Hair Extensions & Wigs" ],
                            [ "name" => "Hair Salon Equipment" ],
                            [ "name" => "Makeup" ],
                            [ "name" => "Makeup Tools" ],
                            [ "name" => "Men Care" ],
                            [ "name" => "Nail Supplies" ],
                            [ "name" => "Oral Hygiene" ],
                            [ "name" => "Other Beauty & Personal Care Products" ],
                            [ "name" => "Sanitary Paper" ],
                            [ "name" => "Shaving & Hair Removal" ],
                            [ "name" => "Skin Care" ],
                            [ "name" => "Skin Care Tool" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Home, Lights & Construction",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Construction & Real Estate",
                        ],
                                     
                        "children" => [
                            [ "name" => "Aluminum Composite Panels" ],
                            [ "name" => "Balustrades & Handrails" ],
                            [ "name" => "Bathroom" ],
                            [ "name" => "Boards" ],
                            [ "name" => "Building Glass" ],
                            [ "name" => "Ceilings" ],
                            [ "name" => "Corner Guards" ],
                            [ "name" => "Countertops,Vanity Tops & Table Tops" ],
                            [ "name" => "Curtain Walls & Accessories" ],
                            [ "name" => "Decorative Films" ],
                            [ "name" => "Door & Window Accessories" ],
                            [ "name" => "Doors & Windows" ],
                            [ "name" => "Earthwork Products" ],
                            [ "name" => "Elevators & Elevator Parts" ],
                            [ "name" => "Escalators & Escalator Parts" ],
                            [ "name" => "Faucets, Mixers & Taps" ],
                            [ "name" => "Fiberglass Wall Meshes" ],
                            [ "name" => "Fireplaces,Stoves" ],
                            [ "name" => "Fireproofing Materials" ],
                            [ "name" => "Floor Heating Systems & Parts" ],
                            [ "name" => "Flooring & Accessories" ],
                            [ "name" => "Formwork" ],
                            [ "name" => "Gates" ],
                            [ "name" => "Heat Insulation Materials" ],
                            [ "name" => "HVAC Systems & Parts" ],
                            [ "name" => "Kitchen" ],
                            [ "name" => "Ladders & Scaffoldings" ],
                            [ "name" => "Landscaping Stone" ],
                            [ "name" => "Masonry Materials" ],
                            [ "name" => "Metal Building Materials" ],
                            [ "name" => "Mosaics" ],
                            [ "name" => "Mouldings" ],
                            [ "name" => "Multifunctional Materials" ],
                            [ "name" => "Other Construction & Real Estate" ],
                            [ "name" => "Plastic Building Materials" ],
                            [ "name" => "Quarry Stone & Slabs" ],
                            [ "name" => "Real Estate" ],
                            [ "name" => "Soundproofing Materials" ],
                            [ "name" => "Stairs & Stair Parts" ],
                            [ "name" => "Stone Carvings and Sculptures" ],
                            [ "name" => "Sunrooms & Glass Houses" ],
                            [ "name" => "Tiles & Accessories" ],
                            [ "name" => "Timber" ],
                            [ "name" => "Tombstones and Monuments" ],
                            [ "name" => "Wallpapers/Wall Coating" ],
                            [ "name" => "Waterproofing Materials" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Home & Garden",
                        ],    
                        "children" => [
                            [ "name" => "Bakeware" ],
                            [ "name" => "Barware" ],
                            [ "name" => "Bathroom Products" ],
                            [ "name" => "Cooking Tools" ],
                            [ "name" => "Cookware" ],
                            [ "name" => "Garden Supplies" ],
                            [ "name" => "Home Decor" ],
                            [ "name" => "Home Storage & Organization" ],
                            [ "name" => "Household Chemicals" ],
                            [ "name" => "Household Cleaning Tools & Accessories" ],
                            [ "name" => "Household Sundries" ],
                            [ "name" => "Kitchen Knives & Accessories" ],
                            [ "name" => "Laundry Products" ],
                            [ "name" => "Pet Products" ],
                            [ "name" => "Kitchen,Dining,Bar & Tableware" ],
                            [ "name" => "Dinnerware" ],
                            [ "name" => "Drinkware" ],
                            [ "name" => "Baby Supplies & Products" ],
                            [ "name" => "Rain Gear" ],
                            [ "name" => "Lighters & Smoking Accessories" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Lights & Lighting",
                        ],

                        "children" => [
                            [ "name" => "Emergency Lighting" ],
                            [ "name" => "Holiday Lighting" ],
                            [ "name" => "Indoor Lighting" ],
                            [ "name" => "LED Lighting" ],
                            [ "name" => "Lighting Accessories" ],
                            [ "name" => "Lighting Bulbs & Tubes" ],
                            [ "name" => "Other Lights & Lighting Products" ],
                            [ "name" => "Outdoor Lighting" ],
                            [ "name" => "Professional Lighting" ],
                            [ "name" => "LED Residential Lighting" ],
                            [ "name" => "LED Outdoor Lighting" ],
                            [ "name" => "Chandeliers & Pendant Lights" ],
                            [ "name" => "Ceiling Lights" ],
                            [ "name" => "Crystal Lights" ],
                            [ "name" => "Stage Lights" ],
                            [ "name" => "Street Lights" ],
                            [ "name" => "Energy Saving & Fluorescent" ],
                            [ "name" => "LED Landscape Lamps" ],
                            [ "name" => "LED Professional Lighting" ],
                            [ "name" => "LED Encapsulation Series" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Furniture",
                        ],
                                           
                        "children" => [
                            [ "name" => "Antique Furniture" ],
                            [ "name" => "Baby Furniture" ],
                            [ "name" => "Bamboo Furniture" ],
                            [ "name" => "Children Furniture" ],
                            [ "name" => "Commercial Furniture" ],
                            [ "name" => "Folding Furniture" ],
                            [ "name" => "Furniture Accessories" ],
                            [ "name" => "Furniture Hardware" ],
                            [ "name" => "Furniture Parts" ],
                            [ "name" => "Glass Furniture" ],
                            [ "name" => "Home Furniture" ],
                            [ "name" => "Inflatable Furniture" ],
                            [ "name" => "Metal Furniture" ],
                            [ "name" => "Other Furniture" ],
                            [ "name" => "Outdoor Furniture" ],
                            [ "name" => "Plastic Furniture" ],
                            [ "name" => "Rattan / Wicker Furniture" ],
                            [ "name" => "Wood Furniture" ],
                            [ "name" => "Living Room Furniture" ],
                            [ "name" => "Bedroom Furniture" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Machinery, Industrial Parts & Tools",
                ],
                
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Machinery",
                        ],               
                        "children" => [
                            [ "name" => "Agriculture Machinery & Equipment" ],
                            [ "name" => "Apparel & Textile Machinery" ],
                            [ "name" => "Building Material Machinery" ],
                            [ "name" => "Chemical Machinery & Equipment" ],
                            [ "name" => "Electronic Products Machinery" ],
                            [ "name" => "Energy & Mineral Equipment" ],
                            [ "name" => "Engineering & Construction Machinery" ],
                            [ "name" => "Food & Beverage Machinery" ],
                            [ "name" => "General Industrial Equipment" ],
                            [ "name" => "Home Product Making Machinery" ],
                            [ "name" => "Industry Laser Equipment" ],
                            [ "name" => "Machine Tool Equipment" ],
                            [ "name" => "Metal & Metallurgy Machinery" ],
                            [ "name" => "Other Machinery & Industry Equipment" ],
                            [ "name" => "Packaging Machine" ],
                            [ "name" => "Paper Production Machinery" ],
                            [ "name" => "Pharmaceutical Machinery" ],
                            [ "name" => "Plastic & Rubber Machinery" ],
                            [ "name" => "Printing Machine" ],
                            [ "name" => "Refrigeration & Heat Exchange Equipment" ],
                            [ "name" => "Used Machinery & Equipment" ],
                            [ "name" => "Woodworking Machinery" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Fabrication Services",
                        ],    
                        "children" => [
                            [ "name" => "Custom Fabrication Services" ],
                            [ "name" => "General Mechanical Components Design Services" ],
                            [ "name" => "General Mechanical Components Stock" ],
                            [ "name" => "Industrial Brake" ],
                            [ "name" => "Machine Tools Accessory" ],
                            [ "name" => "Moulds" ],
                            [ "name" => "Other General Mechanical Components" ],
                            [ "name" => "Other Mechanical Parts" ],
                            [ "name" => "Used General Mechanical Components" ],
                            [ "name" => "Coating Services" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Tools & Hardware",
                        ],
                                    
                        "children" => [
                            [ "name" => "Hardware" ],
                            [ "name" => "Hand Tools" ],
                            [ "name" => "Material Handling Tools" ],
                            [ "name" => "Power Tool Accessories" ],
                            [ "name" => "Power Tools" ],
                            [ "name" => "Tool Design Services" ],
                            [ "name" => "Tool Parts" ],
                            [ "name" => "Tool Processing Services" ],
                            [ "name" => "Tool Sets" ],
                            [ "name" => "Tool Stock" ],
                            [ "name" => "Knife" ],
                            [ "name" => "Hand Carts & Trolleys" ],
                            [ "name" => "Lawn Mower" ],
                            [ "name" => "Sander" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Metallurgy, Chemicals, Rubber & Plastics",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Minerals & Metallurgy",
                        ],
                                                             
                        "children" => [
                            [ "name" => "Aluminum" ],
                            [ "name" => "Barbed Wire" ],
                            [ "name" => "Billets" ],
                            [ "name" => "Carbon" ],
                            [ "name" => "Carbon Fiber" ],
                            [ "name" => "Cast & Forged" ],
                            [ "name" => "Cemented Carbide" ],
                            [ "name" => "Ceramic Fiber Products" ],
                            [ "name" => "Ceramics" ],
                            [ "name" => "Copper" ],
                            [ "name" => "Copper Forged" ],
                            [ "name" => "Fiberglass Products" ],
                            [ "name" => "Glass" ],
                            [ "name" => "Graphite Products" ],
                            [ "name" => "Ingots" ],
                            [ "name" => "Iron" ],
                            [ "name" => "Lead" ],
                            [ "name" => "Lime" ],
                            [ "name" => "Magnetic Materials" ],
                            [ "name" => "Metal Scrap" ],
                            [ "name" => "Metal Slabs" ],
                            [ "name" => "Mineral Wool" ],
                            [ "name" => "Molybdenum" ],
                            [ "name" => "Nickel" ],
                            [ "name" => "Non-Metallic Mineral Deposit" ],
                            [ "name" => "Ore" ],
                            [ "name" => "Other Metals & Metal Products" ],
                            [ "name" => "Other Non-Metallic Minerals & Products" ],
                            [ "name" => "Pig Iron" ],
                            [ "name" => "Quartz Products" ],
                            [ "name" => "Rare Earth & Products" ],
                            [ "name" => "Rare Earth Magnets" ],
                            [ "name" => "Refractory" ],
                            [ "name" => "Steel" ],
                            [ "name" => "Titanium" ],
                            [ "name" => "Tungsten" ],
                            [ "name" => "Wire Mesh" ],
                            [ "name" => "Zinc" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Chemicals",
                        ],
                                  
                        "children" => [
                            [ "name" => "Gas Disposal" ],
                            [ "name" => "Noise Reduction Device" ],
                            [ "name" => "Other Environmental Products" ],
                            [ "name" => "Other Excess Inventory" ],
                            [ "name" => "Recycling" ],
                            [ "name" => "Sewer" ],
                            [ "name" => "Waste Management" ],
                            [ "name" => "Water Treatment" ],
                            [ "name" => "Textile Waste" ],
                            [ "name" => "Waste Paper" ],
                            [ "name" => "Other Recycling Products" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Rubber & Plastics",
                        ],                 
                        "children" => [
                            [ "name" => "Plastic Processing Service" ],
                            [ "name" => "Plastic Products" ],
                            [ "name" => "Plastic Projects" ],
                            [ "name" => "Plastic Raw Materials" ],
                            [ "name" => "Plastic Stocks" ],
                            [ "name" => "Recycled Plastic" ],
                            [ "name" => "Recycled Rubber" ],
                            [ "name" => "Rubber Processing Service" ],
                            [ "name" => "Rubber Products" ],
                            [ "name" => "Rubber Projects" ],
                            [ "name" => "Rubber Raw Materials" ],
                            [ "name" => "Rubber Stocks" ],
                            [ "name" => "Plastic Cards" ],
                            [ "name" => "PVC" ],
                            [ "name" => "Plastic Tubes" ],
                            [ "name" => "HDPE" ],
                            [ "name" => "Rubber Hoses" ],
                            [ "name" => "Plastic Sheets" ],
                            [ "name" => "LDPE" ],
                            [ "name" => "Agricultural Rubber" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Energy",
                        ],
                                         
                        "children" => [
                            [ "name" => "Biodiesel" ],
                            [ "name" => "Biogas" ],
                            [ "name" => "Charcoal" ],
                            [ "name" => "Coal" ],
                            [ "name" => "Coal Gas" ],
                            [ "name" => "Coke Fuel" ],
                            [ "name" => "Crude Oil" ],
                            [ "name" => "Electricity Generation" ],
                            [ "name" => "Petrochemical Products" ],
                            [ "name" => "Solar Energy Products" ],
                            [ "name" => "Industrial Fuel" ],
                            [ "name" => "Natural Gas" ],
                            [ "name" => "Other Energy Related Products" ],
                            [ "name" => "Wood Pellets" ],
                            [ "name" => "Solar Energy Systems" ],
                            [ "name" => "Lubricant" ],
                            [ "name" => "Diesel Fuel" ],
                            [ "name" => "Solar Collectors" ],
                        ]
                    ],
                ]
                
            ],
            [
                "attributes" => [
                    "name" => "Packaging, Advertising & Office",
                ],
                "children" => [
                    [
                        "attributes" => [
                            "name" => "Packaging & Printing",
                        ],                         
                        "children" => [
                            [ "name" => "Adhesive Tape" ],
                            [ "name" => "Agricultural Packaging" ],
                            [ "name" => "Aluminum Foil" ],
                            [ "name" => "Apparel Packaging" ],
                            [ "name" => "Blister Cards" ],
                            [ "name" => "Bottles" ],
                            [ "name" => "Cans" ],
                            [ "name" => "Chemical Packaging" ],
                            [ "name" => "Composite Packaging Materials" ],
                            [ "name" => "Cosmetics Packaging" ],
                            [ "name" => "Electronics Packaging" ],
                            [ "name" => "Food Packaging" ],
                            [ "name" => "Gift Packaging" ],
                            [ "name" => "Handles" ],
                            [ "name" => "Hot Stamping Foil" ],
                            [ "name" => "Jars" ],
                            [ "name" => "Lids, Bottle Caps, Closures" ],
                            [ "name" => "Media Packaging" ],
                            [ "name" => "Metallized Film" ],
                            [ "name" => "Other Packaging Applications" ],
                            [ "name" => "Other Packaging Materials" ],
                            [ "name" => "Packaging Bags" ],
                            [ "name" => "Packaging Boxes" ],
                            [ "name" => "Packaging Labels" ],
                            [ "name" => "Packaging Trays" ],
                            [ "name" => "Packaging Tubes" ],
                            [ "name" => "Paper & Paperboard" ],
                            [ "name" => "Paper Packaging" ],
                            [ "name" => "Pharmaceutical Packaging" ],
                            [ "name" => "Plastic Film" ],
                            [ "name" => "Plastic Packaging" ],
                            [ "name" => "Printing Materials" ],
                            [ "name" => "Printing Services" ],
                            [ "name" => "Protective Packaging" ],
                            [ "name" => "Pulp" ],
                            [ "name" => "Shrink Film" ],
                            [ "name" => "Strapping" ],
                            [ "name" => "Stretch Film" ],
                            [ "name" => "Tobacco Packaging" ],
                            [ "name" => "Transport Packaging" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Office & School Supplies",
                        ],                          
                        "children" => [
                            [ "name" => "Art Supplies" ],
                            [ "name" => "Badge Holder & Accessories" ],
                            [ "name" => "Board" ],
                            [ "name" => "Board Eraser" ],
                            [ "name" => "Book Cover" ],
                            [ "name" => "Books" ],
                            [ "name" => "Calculator" ],
                            [ "name" => "Calendar" ],
                            [ "name" => "Clipboard" ],
                            [ "name" => "Correction Supplies" ],
                            [ "name" => "Desk Organizer" ],
                            [ "name" => "Drafting Supplies" ],
                            [ "name" => "Easels" ],
                            [ "name" => "Educational Supplies" ],
                            [ "name" => "Filing Products" ],
                            [ "name" => "Letter Pad / Paper" ],
                            [ "name" => "Magazines" ],
                            [ "name" => "Map" ],
                            [ "name" => "Notebooks & Writing Pads" ],
                            [ "name" => "Office Adhesives & Tapes" ],
                            [ "name" => "Office Binding Supplies" ],
                            [ "name" => "Office Cutting Supplies" ],
                            [ "name" => "Office Equipment" ],
                            [ "name" => "Office Paper" ],
                            [ "name" => "Other Office & School Supplies" ],
                            [ "name" => "Paper Envelopes" ],
                            [ "name" => "Pencil Cases & Bags" ],
                            [ "name" => "Pencil Sharpeners" ],
                            [ "name" => "Printer Supplies" ],
                            [ "name" => "Stamps" ],
                            [ "name" => "Stationery Set" ],
                            [ "name" => "Stencils" ],
                            [ "name" => "Writing Accessories" ],
                            [ "name" => "Writing Instruments" ],
                            [ "name" => "Yellow Pages" ],
                        ]
                    ],
                    [
                        "attributes" => [
                            "name" => "Service Equipment",
                        ],              
                        "children" => [
                            [ "name" => "Advertising Equipment" ],
                            [ "name" => "Cargo & Storage Equipment" ],
                            [ "name" => "Commercial Laundry Equipment" ],
                            [ "name" => "Financial Equipment" ],
                            [ "name" => "Funeral Supplies" ],
                            [ "name" => "Other Service Equipment" ],
                            [ "name" => "Restaurant & Hotel Supplies" ],
                            [ "name" => "Store & Supermarket Supplies" ],
                            [ "name" => "Trade Show Equipment" ],
                            [ "name" => "Vending Machines" ],
                            [ "name" => "Wedding Supplies" ],
                            [ "name" => "Display Racks" ],
                            [ "name" => "Advertising Players" ],
                            [ "name" => "Advertising Light Boxes" ],
                            [ "name" => "Hotel Amenities" ],
                            [ "name" => "POS Systems" ],
                            [ "name" => "Supermarket Shelves" ],
                            [ "name" => "Stacking Racks & Shelves" ],
                            [ "name" => "Refrigeration Equipment" ],
                            [ "name" => "Trade Show Tent" ],
                        ]
                    ],
                ]
                
            ],
        ];

        foreach($productCategories as $category_arr) {
            $master_cat_arr = $category_arr['attributes'];
            $master_cat_arr['created_at'] = \Carbon::now();
            $cat = ProductCategories::create($master_cat_arr);
            if(count($category_arr['children']) > 0){

                foreach($category_arr['children']as $main_category_arr) {
                    $main_cat_arr = $main_category_arr['attributes'];
                    $main_cat_arr['created_at'] = \Carbon::now();
                    $main_category = new ProductCategories($main_cat_arr);
                    $cat->masterChild()->save($main_category);

                    if(count($main_category_arr['children']) > 0){
                        $sub_cat_obj_arr = [];
                        foreach($main_category_arr['children']as $sub_cat_arr) {
                            $sub_cat_arr['master_product_category_id'] = $cat->id;
                            $sub_cat_arr['created_at'] = \Carbon::now();
                            $sub_cat_obj_arr[] = new ProductCategories($sub_cat_arr);
                        }
                        $main_category->mainChild()->saveMany($sub_cat_obj_arr);
                    }
                }
                
            }
            
        }
    }
}