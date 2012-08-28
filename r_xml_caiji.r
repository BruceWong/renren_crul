# 很多时候我们需要从某个网站上获取原始数据，本例试图利用XML包来获取google top1000的表格数据。

# 首先读入必要的工具包
library(XML)
library(RColorBrewer)
# 利用readHTMLTable函数获取top1000的表格数据，并存入到raw变量中。
u = "http://www.google.com/adplanner/static/top1000/"
tables = readHTMLTable(u)
raw = tables[[2]]
colnames(raw)=c('Rank','Site','Category','Users','Reach','Views','Advertising?')
# 按网站所属行业进行数据汇集
attach(raw)
hangye = aggregate(Category,list(Category),FUN=length)
# 然后按行业进行排序
hangye1 = hangye[order(hangye$x,decreasing = T),]
hangye1[1:8,]


# Group.1 x
# 223 Web Portals 67
# 2 39
# 144 Online Games 30
# 140 News 28
# 181 Social Networks 27
# 141 Newspapers 23
# 173 Search Engines 22
# 149 Online Video 21 

# 最后绘制条形图，看到网站数量最多的行业是门户网站，其次是未标明的其它类，第三是在线游戏，
barplot(hangye1[1:8,]$x,names.arg=hangye1[1:8,]$Group.1, col=brewer.pal(8,"Set1"),border="white",ylim=c(0,70),ylab="本行业的网站数目",
main="谷歌Top1000网站前八大行业")