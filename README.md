敏捷Scrum框架支持工具
=======
Scrum framework support tools

框架：TZN-Framework 0.0.8
前端：bootstrap3.0

流程:
1. 填写面板信息
2. 跳转至面板操作页面(记录下URL)
3. 每天定期更新

功能:
1. 排除日期
2. 实时燃尽图
3. 导出燃尽图

数据库
<pre>
CREATE TABLE `board` (                                                  
          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',                    
          `bname` varchar(25) NOT NULL COMMENT '名称',                          
          `begintime` date NOT NULL COMMENT '开始时间',                         
          `endtime` date NOT NULL COMMENT '结束时间',                           
          `exceptdays` varchar(100) NOT NULL COMMENT '排除日期',                
          `dwz` varchar(6) NOT NULL COMMENT '短网址',                           
          PRIMARY KEY (`id`),                                                   
          UNIQUE KEY `dwz` (`dwz`)                                              
        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='面板表'  
        
CREATE TABLE `task` (                                                      
          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',                       
          `fid` int(11) NOT NULL COMMENT '面板ID',                                   
          `story` varchar(50) NOT NULL COMMENT '故事',                             
          `owner` varchar(15) NOT NULL COMMENT '拥有者',                           
          `expendt` date NOT NULL COMMENT '预计完成',                              
          `workload` varchar(100) NOT NULL COMMENT '工作量',                       
          `is_del` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除(1:删除,0:正常)',     
          PRIMARY KEY (`id`),                                                      
          KEY `fid` (`fid`)                                                        
        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='故事表'  
</pre>