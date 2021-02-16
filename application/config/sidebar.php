<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$config['sidebar'] = [

  'superadmin' => [

      'Manage User' => [
                           'icon'=>'fa fa-user',
                           'id'=>'user',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add User'=>'Users/add_user' , 'View User' => 'Users/view_user' ]
      ],

      'Manage Project' => [
                           'icon'=>'fa fa-folder',
                           'id'=>'project',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[
                                    'Add Project'=>'Project' ,
                                    'View Project'=>'Project/view_project',
                                    'Assign Project' => 'Project/assign_to_user'
                                  ]
      ],

      'Manage Kit' => [
                           'icon'=>'fa fa-medkit',
                           'id'=>'kit',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Kit'=>'Kit' , 'View Kit'=>'Kit/view_kit' ]
      ],

      'Manage Client' => [
                           'icon'=>'fa fa-user',
                           'id'=>'client',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Client'=>'Users/client' , 'View Client'=>'Users/view_client' ]
      ],

      'Manage Coupon' => [
                           'icon'=>'fa fa-tag',
                           'id'=>'coupon',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Coupon'=>'Coupon' , 'View Coupon'=>'Coupon/view_coupon' ]
      ],

      'Manage Company' => [
                           'icon'=>'fa fa-building',
                           'id'=>'company',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Company'=>'Company' ]
      ],

      'Manage Request' => [
                           'icon'=>'fa fa-plus',
                           'id'=>'req',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Request'=>'Samples/request_sample','View Request'=>'Request/total_request']
      ],

      'Manage Test' => [
                           'icon'=>'fa fa-indent',
                           'id'=>'test',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[
                                    'Add Test'=>'Test',
                                    'View Test'=>'Test/total_test'
                                 ]
      ],
      'Patients' => ['icon'=> 'fa fa-user',
                     'id'=>'patients',
                     'href'=>'Do',
                     'isSubmenu'=>true,
                     'url'=>['View Patients'=>'Patients/view_patients']
      ],


  ],


 'project_manager' => [

      'Manage Project' => [
                             'icon'=>'fa fa-folder',
                             'id'=>'email',
                             'href'=>'Do',
                             'isSubmenu'=>true,
                             'url'=>[
                                    'Add Project'=>'Project' ,
                                    'View Project' =>'Project/view_project' ,
                                    'Assign Project' => 'Project/assign_to_user'
                              ]
        ],

        'Project Co-ordinate' =>[
                                       'icon'=>'fa fa-user-o',
                                       'id'=>'project_cordinate',
                                       'href'=>'Do',
                                       'isSubmenu'=>true,
                                       'url'=>[
                                                'Add'=>'Users/project_cordinate',
                                                'List'=>'Users/list_project_cordinate'
                                               ]
                              ],

        'Sister Lab' =>[
                                       'icon'=>'fa fa-user-o',
                                       'id'=>'sisterlab',
                                       'href'=>'Do',
                                       'isSubmenu'=>true,
                                       'url'=>[
                                                'Add'=>'Sisterlab',
                                                'List'=>'Sisterlab/sister_lab_view'
                                               ]
                              ],

         'Manage Client' => ['icon'=>'fa fa-user',
							 'id'=>'client',
							 'href'=>'Do',
                             'isSubmenu'=>true,
                             'url'=>[ 'Add Client'=>'Users/client' , 'View Client'=>'Users/view_client' ]
							 ],



      // 'Manage Request' => [
      //                      'icon'=>'fa fa-plus',
      //                      'id'=>'req',
      //                      'href'=>'Do',
      //                      'isSubmenu'=>true,
      //                      'url'=>[
      //                              'Add Request'=>'Samples/request_sample',
      //                              'View Request'=>'Request/total_request',
      //                              'New Request' =>'Request/new_total_request',
      //                              'Denied Request' => 'Request/denied_request',
      //                              'Collected Request' =>'Request/collected_request'

      //                            ]
      // ],
          'Manage Request' => [
                           'icon'=>'fa fa-plus',
                           'id'=>'req',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Request'=>'Samples/request_sample','View Request'=>'Request/total_request']
      ],



    ],


    'manager' => [
        // 'Users' => [
        //                      'icon'=>'fa fa-user',
        //                      'id'=>'task',
        //                      'href'=>'Do',
        //                      'isSubmenu'=>true,
        //                      'url'=>[
        //                         'Add Users'=>'Users/client' ,
        //                         'View Users'=>'Users/client_user'
        //                       ]
        //             ],
       'Manage Request' => [
                           'icon'=>'fa fa-plus',
                           'id'=>'req',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Request'=>'Samples/request_sample','View Request'=>'Request/total_request']
      ],

      ],



 'zonal_manager' => [
            //   'User' => [
            //                       'icon'=>'fa fa-user',
            //                       'id'=>'task',
            //                       'href'=>'Do',
            //                       'isSubmenu'=>true,
            //                       'url'=>[
            //                           'Add User'=>'Users/client' ,
            //                           'View User'=>'Users/client_user'
            //                         ]
            //               ],
              // 'View Request' => [
              //                      'icon'=>'fa fa-plus',
              //                      'id'=>'task',
              //                      'href'=>'Do',
              //                      'isSubmenu'=>false,
              //                      'url'=>'Request/total_request'
              //             ],
             'Manage Request' => [
                           'icon'=>'fa fa-plus',
                           'id'=>'req',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Request'=>'Samples/request_sample','View Request'=>'Request/total_request']
      ],
    ],



    'requestor' => [


              'Request' => [
                                   'icon'=>'fa fa-pencil',
                                   'id'=>'req',
                                   'href'=>'Do',
                                   'isSubmenu'=>true,
                                   'url'=>[ 'Add Request'=>'Samples/request_sample',
                                           'View Request'=>'Request/total_request']
              ],

    ],




    'project_cordinate' => [

          'Manage Project' => [
                               'icon'=>'fa fa-folder',
                               'id'=>'email',
                               'href'=>'Do',
                               'isSubmenu'=>true,
                               'url'=>[ 'View Project' =>'Project/view_project' ]
          ],

           'Manage Request' => [
                           'icon'=>'fa fa-plus',
                           'id'=>'req',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Request'=>'Samples/request_sample','View Request'=>'Request/total_request']
      ],
  ],



  'phelbotomist' => [
          // 'Task' => [
          //                      'icon'=>'fa fa-pencil',
          //                      'id'=>'task',
          //                      'href'=>'Do',
          //                      'isSubmenu'=>true,
          //                      'url'=>[
          //                         'Requested Task'=>'Task/request' ,
          //                         'Accepted Task' => 'Task/view_task',
          //                         'Finished Task' => 'Task/finished_task'
          //                       ]
          //             ],

          'View Request' => [
                                 'icon'=>'fa fa-pencil',
                                 'id'=>'request',
                                 'href'=>'Do',
                                 'isSubmenu'=>true,
                                 'url'=>[
                                    'View Request'=>'Request/total_request' ,
                                  ]
                        ],
    ],


     'logistic' => [
          // 'Task' => [
          //                      'icon'=>'fa fa-pencil',
          //                      'id'=>'task',
          //                      'href'=>'Do',
          //                      'isSubmenu'=>true,
          //                      'url'=>[
          //                         'Requested Task'=>'Task/request' ,
          //                         'Accepted Task' => 'Task/view_task',
          //                         'Finished Task' => 'Task/finished_task'
          //                       ]
          //             ],

          'View Request' => [
                                 'icon'=>'fa fa-pencil',
                                 'id'=>'request',
                                 'href'=>'Do',
                                 'isSubmenu'=>true,
                                 'url'=>[
                                    'View Request'=>'Request/total_request' ,
                                  ]
                        ],
    ],

  'sister_lab' => [
            'Task' => [
                                 'icon'=>'fa fa-pencil',
                                 'id'=>'task',
                                 'href'=>'Do',
                                 'isSubmenu'=>true,
                                 'url'=>[
                                    'Completed Task'=>'Task/completed_task' ,
                                  ]

                        ],

               'New Phelbo' => [
                                 'icon'=>'fa fa-pencil',
                                 'id'=>'requests',
                                 'href'=>'Do',
                                 'isSubmenu'=>true,
                                 'url'=>[
                                   'Add New Phelbo' => 'Sister_Request/new_phelbo',
                                  ]
                        ],

                'New Logistic' => [
                                 'icon'=>'fa fa-pencil',
                                 'id'=>'requestss',
                                 'href'=>'Do',
                                 'isSubmenu'=>true,
                                 'url'=>[
                                   'Add New Logistic' => 'Logistic_sister/new_logistic',
                                  ]
                        ],

                'Request' => [
                                 'icon'=>'fa fa-pencil',
                                 'id'=>'request',
                                 'href'=>'Do',
                                 'isSubmenu'=>true,
                                 'url'=>[
                                    'View Request'=>'Request/total_request' ,
                                  ]
                        ],
      ],


  'grl_lab' => [
            'Task' => [
                                 'icon'=>'fa fa-pencil',
                                 'id'=>'task',
                                 'href'=>'Do',
                                 'isSubmenu'=>true,
                                 'url'=>[
                                    'Completed Task'=>'Task/sended_task' ,
                                  ]
                        ],
      ],


  'business_head' => [
                'Users' => [
                                     'icon'=>'fa fa-pencil',
                                     'id'=>'task',
                                     'href'=>'Do',
                                     'isSubmenu'=>true,
                                     'url'=>[
                                        'Add Users'=>'Users/client' ,
                                        'View Users'=>'Users/client_user'
                                      ]
                            ],
                'Manage Project' => [
                                       'icon'=>'fa fa-folder',
                                       'id'=>'email',
                                       'href'=>'Do',
                                       'isSubmenu'=>true,
                                       'url'=>[
                                                'View Project' =>'Project/view_project' ,
                                                'Assign Project' => 'Project/assign_to_user'
                                              ]
                  ],

  ],


  'call_center' => [
      'Manage Request' => [
                           'icon'=>'fa fa-plus',
                           'id'=>'request',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[
                                    'New Request' =>'Request/new_total_request',
                                    'Denied Request' => 'Request/denied_request',
                                    'Collected Request' =>'Request/collected_request'
                            ]
      ]
    ],

   'mhl' => [
                        'Total Project' => [
                                               'icon'=>'fa fa-list-alt',
                                               'href'=>'Home',
                                               'id'=>'home',
                                               'isSubmenu'=>false,
                                               'url'=>'Project/view_project'
                                           ],

                       // 'Forms' => [
                       //                      'icon'=>'fa fa-pencil',
                       //                      'id'=>'email',
                       //                      'href'=>'Do',
                       //                      'isSubmenu'=>true,
                       //                      'url'=>[
                       //                                'Client Master'=>'Form/client_master' ,
                       //                                'Coupon Master' =>'Form/coupon_master',
                       //                                'Request Samples Collection' =>'Form/request_sample_collection',
                       //                                'Samples Registration' => 'Form/sample_registration',
                       //                                'User Mapping' => 'Form/user_mapping',
                       //                                'Phelbotomist' =>'Form/phelbotomist',
                       //                                'Phelbotomist Payment' => 'Form/phelbotomist_payment'
                       //
                       //
                       //
                       //                              ]
                       //             ],

                      'Manage Request' => [
                           'icon'=>'fa fa-plus',
                           'id'=>'req',
                           'href'=>'Do',
                           'isSubmenu'=>true,
                           'url'=>[ 'Add Request'=>'Samples/request_sample','View Request'=>'Request/total_request']
      ],

            ]



];
