<?php 
    class LinkModel extends Model{      
        public $id;
		public $webname;
		public $weburl;
		public $logourl;
		public $type;
		public $state;
		public $user;
		public $limit;
         //拦截器__set()
//         public function __set($_key,$_value){
//             $this->_key=Tool::addString($_value);
//         }
//         //拦截器__get()
//         public function __get($_key){
//             return $this->_key;
//         } 
        //获取一个友情链接
         public function getOneLink(){
            $sql="select id,
						webname,
						weburl,
						logourl,
						type,
						user,
						state
                from cms_friendlink
                where id='$this->id' or webname='$this->webname'";
           return parent::one($sql);            
        } 
        //获取友情链接数据总数
        public function getTotal(){
            $sql="select id from cms_friendlink";
            return parent::total($sql);
        }
        //获取全部友情链接,带limit       
        public function getAllLink(){                       
            $sql="select id,
						webname,
						weburl,
						weburl fullweburl,
						logourl,
						logourl fulllogourl,
						type,
						user,
						state
                    from cms_friendlink
                    order by state desc,date desc
                  $this->limit";
            return parent::all($sql);       
        }
        //前14个文字链接
        public function getTwentyTextLink() {
            $_sql = "SELECT
												webname,
												weburl
								FROM
												cms_friendlink
								WHERE
												state=1
									AND
												type=1
							ORDER BY
												date DESC
								LIMIT
												0,14";
            return parent::all($_sql);
        }
        
        //前9个Logo链接
        public function getNineLogoLink() {
            $_sql = "SELECT
												webname,
												weburl,
												logourl
								FROM
												cms_friendlink
								WHERE
												state=1
									AND
												type=2
							ORDER BY
												date DESC
								LIMIT
												0,9";
            return parent::all($_sql);
        }
        //所有文字链接，state=1
        public function getAllTextLink() {
            $_sql = "SELECT
												webname,
												weburl
								FROM
												cms_friendlink
								WHERE
												state=1
									AND
												type=1
							ORDER BY
												date DESC";
            return parent::all($_sql);
        }
        
        //所有Logo链接，state=1
        public function getAllLogoLink() {
            $_sql = "SELECT
												webname,
												weburl,
												logourl
								FROM
												cms_friendlink
								WHERE
												state=1
									AND
												type=2
							ORDER BY
												date DESC";
            return parent::all($_sql);
        }
        //修改友情链接
         public function updateLink(){         
            $sql="update cms_friendlink
                        set webname='$this->webname',
                            weburl='$this->weburl',
                            logourl='$this->logourl',
                            user='$this->user',
                            type='$this->type'
                        where id=$this->id";
            return parent::asu($sql);            
            
        }
        //新增
		public function addLink() {
			$sql = "INSERT INTO 
						cms_friendlink (
								webname,
								weburl,
								logourl,
								user,
								type,
								state,
								date
										) 
						VALUES (
												'$this->webname',
												'$this->weburl',
												'$this->logourl',
												'$this->user',
												'$this->type',
												'$this->state',
												NOW()
										)";
			return parent::asu($sql);
		}
        //设置审核通过
        public function setStateOk(){
            $sql="update cms_friendlink set state=1 where id='$this->id'";
            return parent::asu($sql);
        }
        //设置审核取消
        public function setStateCancel(){
            $sql="update cms_friendlink set state=0 where id='$this->id'";
            return parent::asu($sql);
        }
        //删除友情链接
        public function deleteVote(){        
           $sql="delete from cms_friendlink where id=$this->id";
           return parent::asu($sql);
        }
    
        
    }
?>