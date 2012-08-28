# �ܶ�ʱ��������Ҫ��ĳ����վ�ϻ�ȡԭʼ���ݣ�������ͼ����XML������ȡgoogle top1000�ı�����ݡ�

# ���ȶ����Ҫ�Ĺ��߰�
library(XML)
library(RColorBrewer)
# ����readHTMLTable������ȡtop1000�ı�����ݣ������뵽raw�����С�
u = "http://www.google.com/adplanner/static/top1000/"
tables = readHTMLTable(u)
raw = tables[[2]]
colnames(raw)=c('Rank','Site','Category','Users','Reach','Views','Advertising?')
# ����վ������ҵ�������ݻ㼯
attach(raw)
hangye = aggregate(Category,list(Category),FUN=length)
# Ȼ����ҵ��������
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

# ����������ͼ��������վ����������ҵ���Ż���վ�������δ�����������࣬������������Ϸ��
barplot(hangye1[1:8,]$x,names.arg=hangye1[1:8,]$Group.1, col=brewer.pal(8,"Set1"),border="white",ylim=c(0,70),ylab="����ҵ����վ��Ŀ",
main="�ȸ�Top1000��վǰ�˴���ҵ")