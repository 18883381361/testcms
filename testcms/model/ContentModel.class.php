<?php 
    class ContentModel extends Model{      
        public $title;
        public $nav;
        public $attr;
        public $tag;
        public $keyword;
        public $thumb;
        public $source;
        public $author;
        public $info;
        public $content;
        public $commend;
        public $count;
        public $sort;
        public $gold;
        public $readlimit;
        public $color;
        public $id;
        public $limit;
        public $inputkeyword;
        //获取某主类下的所有文档
        public function getOneListContent(){
            $sql="select id,title,date from cms_content 
                    where nav in(select id from cms_nav where pid='$this->id') 
                    order by date desc 
                    limit 0,11";
            return parent::all($sql);
        }
        //获取前台列表
        public function getAllList(){
            $sql="select c.id,c.attr,c.title,c.title t,c.keyword,c.nav,c.count,c.thumb,c.info,c.date,n.nav_name from 
                        cms_content as c,cms_nav as n
                    where 
                        c.nav='$this->nav' and c.nav=n.id order by date desc $this->limit";
           return parent::all($sql);
        }
        //按标题搜索
        public function searchTitle(){
            $sql="select c.id,c.attr,c.keyword,c.title,c.title t,c.nav,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where
            c.title LIKE '%$this->inputkeyword%' and c.nav=n.id order by date desc $this->limit";
            return parent::all($sql);
        }
        //按标题搜索数据总数
        public function searchTitleTotal(){
            $sql="select id from cms_content where title LIKE '%$this->inputkeyword%'";
            return parent::total($sql);
        }
        //按关键字搜索
        public function searchKeyword(){
            $sql="select c.id,c.attr,c.keyword,c.title,c.title t,c.nav,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where
            c.keyword LIKE '%$this->inputkeyword%' and c.nav=n.id order by date desc $this->limit";
            return parent::all($sql);
        }
        //按关键字搜索数据总数
        public function searchKeywordTotal(){
            $sql="select id from cms_content where keyword LIKE '%$this->inputkeyword%'";
            return parent::total($sql);
        }
        //按Tag标签搜索
        public function searchTag(){
            $sql="select c.id,c.attr,c.keyword,c.title,c.title t,c.nav,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where
            c.tag LIKE '%$this->inputkeyword%' and c.nav=n.id order by date desc $this->limit";
            return parent::all($sql);
        }
        //按Tag标签搜索数据总数
        public function searchTagTotal(){
            $sql="select id from cms_content where tag LIKE '%$this->inputkeyword%'";
            return parent::total($sql);
        }
        //新增tag标签
        public function addTag(){
            $sql="insert into cms_tag(tagname) values('$this->inputkeyword')";
            return parent::asu($sql);
        }
        //获取一个tag标签
        public function getOneTag(){
            $sql="select id from cms_tag where tagname='$this->inputkeyword'";
            return parent::one($sql);
        }
        //设置Tag标签count加一
        public function setCount(){
            $sql="update cms_tag set count=count+1 where tagname='$this->inputkeyword'";
            return parent::asu($sql);
        }
        //获取前十个tag标签
        public function getTenTag(){
            $sql="select id,tagname,count from cms_tag order by count desc";
            return parent::all($sql);
        }
        //获取某主类下面的所有子类列表
        public function getAllChildList(){
            $sql="select c.id,c.attr,c.title,c.title t,c.count,c.keyword,c.thumb,c.info,c.date,n.nav_name from 
                                cms_content as c,cms_nav as n 
                         where nav in(
                select id from cms_nav where pid='$this->id') and c.nav=n.id order by date desc $this->limit";
            return parent::all($sql);
        }
        //获取所有子类列表
        public function getAllListContent(){
            $sql="select c.id,c.attr,c.title,c.title t,c.count,c.nav,c.thumb,c.info,c.date,n.nav_name from 
                                cms_content as c,cms_nav as n 
                        where c.nav in(
            select id from cms_nav where pid!=0) and c.nav=n.id $this->limit";
            return parent::all($sql);
        }
        //获取某主类本月、本类、推荐文档
        public function getChildMonthNavRec(){
            $sql="select c.id,c.attr,c.title,c.title t,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where nav in(
            select id from cms_nav where pid='$this->id') 
                and c.nav=n.id 
                and MONTH(NOW())=DATE_FORMAT(c.date,'%c')
                and c.attr LIKE '%推荐%'
            order by date desc limit 0,10";
            return parent::all($sql);
        }
        //获取所有子类本月、本类、推荐文档
        public function getMonthNavRec(){
            $sql="select c.id,c.attr,c.title,c.title t,c.nav,c.count,c.thumb,c.info,c.date,n.nav_name from 
                            cms_content as c,cms_nav as n
                        where 
                            c.nav='$this->nav' 
                            and c.nav=n.id 
                            and MONTH(NOW())=DATE_FORMAT(c.date,'%c')
                            and c.attr LIKE '%推荐%'
                        order by date desc limit 0,10";
               return parent::all($sql);
        }
        //获取某主类本月、本类、热点文档
        public function getChildMonthNavHot(){
            $sql="select c.id,c.attr,c.title,c.title t,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where nav in(
            select id from cms_nav where pid='$this->id')
            and c.nav=n.id
            and MONTH(NOW())=DATE_FORMAT(c.date,'%c')
            order by(select count(*) from cms_commend as m where m.cid=c.id) desc limit 0,10";
            return parent::all($sql);
        }
        //获取所有子类本月、本类、热点文档
        public function getMonthNavHot(){
            $sql="select c.id,c.attr,c.title,c.title t,c.nav,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where
            c.nav='$this->nav'
            and c.nav=n.id
            and MONTH(NOW())=DATE_FORMAT(c.date,'%c')
            order by(select count(*) from cms_commend as m where m.cid=c.id) desc limit 0,10";
            return parent::all($sql);
        }
        //获取某主类本月、本类、图文文档
        public function getChildMonthNavPic(){
            $sql="select c.id,c.attr,c.title,c.title t,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where nav in(
            select id from cms_nav where pid='$this->id')
            and c.nav=n.id
            and MONTH(NOW())=DATE_FORMAT(c.date,'%c')
            and c.thumb<>''
            order by date desc limit 0,10";
            return parent::all($sql);
        }
        //获取所有子类本月、本类、图文文档
        public function getMonthNavPic(){
            $sql="select c.id,c.attr,c.title,c.title t,c.nav,c.count,c.thumb,c.info,c.date,n.nav_name from
            cms_content as c,cms_nav as n
            where
            c.nav='$this->nav'
            and c.nav=n.id
            and MONTH(NOW())=DATE_FORMAT(c.date,'%c')
            and c.thumb<>''
            order by date desc limit 0,10";
            return parent::all($sql);
        }
        //获取最新的7条特别推荐
        public function getNewRec(){
            $sql="select id,title,date
                    from cms_content 
                    where attr LIKE '%推荐%'
                    and MONTH(NOW())=DATE_FORMAT(date,'%c')
                    order by date desc
                    limit 0,7";
            return parent::all($sql);
        }
        //获取最新的7条本月热点
        public function getNewHot(){
            $sql="select id,title,date
                    from cms_content
                    where MONTH(NOW())=DATE_FORMAT(date,'%c')
                    order by count desc
                    limit 0,7";
            return parent::all($sql);
        }
        //获取最新的7条本月评论
        public function getNewCom(){
            $sql="select c.id,c.title,c.date
                    from cms_content as c
                    where MONTH(NOW())=DATE_FORMAT(c.date,'%c')
                    order by (select count(*) from cms_commend as m where m.cid=c.id)
                    limit 0,7";
            return parent::all($sql);
        }
        //获取最新的4条图文资讯
        public function getNewPic(){
             $sql="select id,title,thumb
                    from cms_content
                    where thumb<>''
                    order by date desc
                    limit 0,4";
            return parent::all($sql);
        }
        //获取最新的1条头条
        public function getNewOneTop(){
            $sql="select id,title,info
                    from cms_content
                    where attr LIKE '%头条%'
                    order by date desc
                    limit 1";
            return parent::one($sql);
        }
        //获取最新的2-5条头条
        public function getNewTop(){
            $sql="select id,title
                    from cms_content
                    where attr LIKE '%头条%'
                    order by date desc
                    limit 1,4";
            return parent::all($sql);
        }
        //获取最新的10条文档
        public function getNewDate(){
            $sql="select id,title,date
                    from cms_content
                    order by date desc
                    limit 0,10";
            return parent::all($sql);
        }
        //获取单一文档内容
        public function getOneList(){
            $sql="select * from cms_content where id=$this->id";
            return parent::one($sql);
        }
        //获取主类数据总数
        public function getChildTotalList(){
            $sql="select id from cms_content where nav='$this->nav'";
            return parent::total($sql);
        }
        //获取某子类数据总数
        public function getTotalList(){
            $sql="select id from cms_content where nav in(
                select id from cms_nav where pid='$this->id')";
            return parent::total($sql);
        }
        //获取全部子类数据总数
        public function getAllTotalList(){
            $sql="select id from cms_content where nav in(
            select id from cms_nav where pid!=0)";
            return parent::total($sql);
        }
       //新增文档
        public function addContent(){
            $this->addstring();
            //$this->nav_info=Tool::addString($this->nav_info);
            $sql="insert into cms_content(
            title,
            attr,
            nav,
            tag,
            keyword,
            thumb,
            source,
            author,
            info,
            content,
            commend,
            count,
            gold,
            color,
            sort,
            readlimit,
            date)
            values(
            '$this->title',
            '$this->attr',
            '$this->nav',
            '$this->tag',
            '$this->keyword',
            '$this->thumb',
            '$this->source',
            '$this->author',
            '$this->info',
            '$this->content',
            '$this->commend',
            '$this->count',
            '$this->gold',
            '$this->color',
            '$this->sort',
            '$this->readlimit',
            NOW())";
            return parent::asu($sql);
        }
        //修改文档
        public function UpdateContent(){
            $this->addstring();
            //$this->nav_info=Tool::addString($this->nav_info);
            $sql="update cms_content set
            title='$this->title',
            attr='$this->attr',
            nav='$this->nav',
            tag='$this->tag',
            keyword='$this->keyword',
            thumb='$this->thumb',
            source='$this->source',
            author='$this->author',
            info='$this->info',
            content='$this->content',
            commend='$this->commend',
            count='$this->count',
            gold='$this->gold',
            color='$this->color',
            sort='$this->sort',
            readlimit='$this->readlimit',
            date=NOW() where id='$this->id'";
            return parent::asu($sql);
        }
        //删除文档
        public function deleteContent(){
            $sql="delete from cms_content where id='$this->id'";
            return parent::asu($sql);
        }
        //统计文档点击量
        public function setContentCount(){
            $sql="update cms_content set count=count+1 where id='$this->id'";
            return parent::asu($sql);
        }
        //addstring
        private function addstring(){
            $this->title=Tool::addString($this->title);
            $this->attr=Tool::addString($this->attr);
            $this->tag=Tool::addString($this->tag);
            $this->keyword=Tool::addString($this->keyword);
            $this->source=Tool::addString($this->source);
            $this->author=Tool::addString($this->author);
            $this->info=Tool::addString($this->info);
           // $this->content=Tool::addString($this->content);
        }
    }
?>