


go get -u github.com/micro/micro
sudo -E bash -c 'echo '     //ʹ�õ�ǰbash�Ļ�������

micro api //apiת��  8080  8082
micro web 
micro list  services         //get query xx��Ŀ xx����

post:
curl -d 'service=mcyun.invitation' -d 'method=InvitaionService.GetInvitationList' -d 'request={"name": "Asim Aslam"}' 


1,consul agent -bootstrap -server -advertise=127.0.0.1 -data-dir=/Users/lcg/data/consul -ui
localhost:8500/ui

micro api 
micro web
2, protoc --go_out=plugins=micro:.   //����pro�ļ�
3,export GOPATH=`pwd`:`pwd`/vendor
export GOBIN=`pwd`/bin
4, go install ./src/mchost/invitation-srv  && ./bin/invitation-srv



consul key  => SourceName
{"mysql":"mcbox:mcboxmysqlgogo@tcp(112.74.207.116:3306)/mcyun"}







  




