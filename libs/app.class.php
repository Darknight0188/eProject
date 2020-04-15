<?php
    class app{
        public function __construct(){

        }

        public function getInfo($str){
            ;
        }

        public function redir($url){
            header("Location:{$url}");
        }

        public function to_Slug($slug){
            $slug = preg_replace('/(á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ)/', 'a', $slug);
            $slug = preg_replace('/(é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ)/', 'e',$slug);
            $slug = preg_replace('/(i|í|ì|ỉ|ĩ|ị)/', 'i',$slug);
            $slug = preg_replace('/(ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ)/', 'o',$slug);
            $slug = preg_replace('/(ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự)/', 'u',$slug);
            $slug = preg_replace('/(ý|ỳ|ỷ|ỹ|ỵ)/', 'y',$slug);
            $slug = preg_replace('/(đ)/', 'd',$slug);
            $slug = preg_replace('/ /', " - ",$slug);
        }

        public function paging($url, $t, $l, $css, $s){
            $pi = '';
            $current = (isset($_GET['page']))?$_GET['page']:1;
            for($i=1;$i<=ceil($t/$l);$i++){
                if($i != $current){
                    if($s != '') $pi .="<li class='page-item'><a href='?{$url}&s={$s}&view={$l}&page={$i}' class='page-link'>{$i}</a></li>";
                    else $pi .= "<li class='page-item'><a href='?{$url}&page={$i}' class='page-link'>{$i}</a></li>";
                } else $pi .= "<li class='page-item'><span class='page-link'>{$i}</span></li>";
            }
            return $pi;
        }

        public function formatPrice($number){
            $number = intval($number);

            return $number =  number_format($number,0,',','.') - "đ";
        }
        public function price_format($price){
			$price = number_format($price, 2, ',', '.');
			$split = explode(',', $price);
			if($split[1] == '00') $price = str_replace(',00', '', $price);
			return $price;
		}
        public function formatpriceSale($number,$sale){
            $number = intval($number);
            $sale = intval($sale);

            $price = $number*(100 - $sale)/100;
            return formatPrice($price);
        }

    }