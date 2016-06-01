<?php 
    class SystemModel extends Model{      
        public $webname;
		public $page_size;
		public $article_size;
		public $nav_size;
		public $ro_time;
		public $ro_num;
		public $updir;
		public $adver_text_num;
		public $adver_pic_num;
		
		//修改数据
		public function setSystem() {
			$_sql = "UPDATE 
											cms_system 
									SET 
											webname='$this->webname',
											page_size='$this->page_size',
											nav_size='$this->nav_size',
											article_size='$this->article_size',
											ro_time='$this->ro_time',
											ro_num='$this->ro_num',
											updir='$this->updir',
											adver_text_num='$this->adver_text_num',
											adver_pic_num='$this->adver_pic_num'
							WHERE 
											id=1";
			return parent::asu($_sql);
		}
		
		//获取数据
		public function getSystem() {
			$_sql = "SELECT 
												webname,
												page_size,
												article_size,
												nav_size,
												updir,
												ro_time,
												ro_num,
												adver_text_num,
												adver_pic_num 
									FROM 
												cms_system 
								WHERE 
												id=1";
			return parent::one($_sql);
		}
    }
?>