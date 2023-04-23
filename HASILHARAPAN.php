<?php

// variabel
$value = ['A', 'B', 'C', 'D'];

// hasil yang di harapkan
$hasil[0][0] = ['A'];                                           $hasil[0]  = ['A'];                                    
$hasil[0][1] = ['B'];                                           $hasil[1]  = ['B'];                                    
$hasil[0][2] = ['C'];                                           $hasil[2]  = ['C'];                                    
$hasil[0][3] = ['D'];                                           $hasil[3]  = ['D'];
$hasil[1][0] = ['A', 'B'];                                      $hasil[4]  = ['A', 'B'];                               
$hasil[1][1] = ['A', 'C'];                                      $hasil[5]  = ['A', 'C'];                               
$hasil[1][2] = ['A', 'D'];        /*   ATAU  -->   */           $hasil[6]  = ['A', 'D'];                               
$hasil[1][3] = ['B', 'C'];                                      $hasil[7]  = ['B', 'C'];                               
$hasil[1][4] = ['B', 'D'];                                      $hasil[8]  = ['B', 'D'];                               
$hasil[1][5] = ['C', 'D'];                                      $hasil[9]  = ['C', 'D'];                               
$hasil[2][0] = ['A', 'B', 'C'];                                 $hasil[10] = ['A', 'B', 'C'];                          
$hasil[2][1] = ['A', 'B', 'D'];                                 $hasil[11] = ['A', 'B', 'D'];                          
$hasil[2][2] = ['B', 'C', 'D'];                                 $hasil[12] = ['B', 'C', 'D'];                          
$hasil[2][3] = ['C', 'D', 'A'];                                 $hasil[13] = ['C', 'D', 'A'];                          
$hasil[3][0] = ['A', 'B', 'C', 'D'];                            $hasil[14] = ['A', 'B', 'C', 'D'];                     



$hasil = array();
foreach ($value as $i => $val) {
//     $hasil[$i] = $val;
//     foreach ($value as $j => $val) {
//     }
}
