#!/bin/bash
#Date:2015-05-09
#Written:
#Readme:install pkg elasticsearch.


export PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
export LANG=C


# ȷ�ϱ����Ƿ��Ѱ�װ��ذ�
PKG_NAME="1.6.0"
LINK_DIR=/usr/local/$PKG_NAME
test -e $LINK_DIR && { echo "Already installed, exit."; exit 1; }


PKG_VERSION="1.5.1"
INSTALL_DIR=/data/services
INSTALL_PATH="$INSTALL_DIR/$PKG_NAME-$PKG_VERSION"
PROGRAM="$PKG_NAME"

LOG_BASE="/data/logs/binlogs"
LOG_DIR="$LOG_BASE/$PROGRAM"

APPS_BASE="/data/apps/binapps"
APPS_DIR="$APPS_BASE/$PROGRAM"

DATA_BASE="/data/apps/bindata"
DATA_DIR="$DATA_BASE/$PROGRAM"

CONF_DIR="$INSTALL_DIR/${PKG_NAME}_conf"


# ������������˳��λ��
STARTUP=59
mkdir -p /data/backup $INSTALL_DIR $LOG_DIR $APPS_DIR $DATA_DIR $CONF_DIR


test -L  /usr/local/$PROGRAM && rm -f  /usr/local/$PROGRAM
test -e  /usr/local/$PROGRAM && mv -v /usr/local/$PROGRAM{,.bak}

ln -s $INSTALL_PATH /usr/local/$PROGRAM || { echo "symbolic directory exists." && exit 1; }

rm -rvf /etc/init.d/$PROGRAM
/bin/cp -fv $INSTALL_PATH/scripts/init.d_$PROGRAM /etc/init.d/$PROGRAM || { echo "Can not create control scripts" && exit 1; }
chown root:root /etc/init.d/$PROGRAM
chmod a+x /etc/init.d/$PROGRAM

cd /etc/rc2.d
test -L S${STARTUP}${PROGRAM} && rm -f S${STARTUP}${PROGRAM}
ln -s  ../init.d/$PROGRAM S59$PROGRAM || { echo "Can not create startup link" && exit 1; }


# ����ǽ���ã�elasticsearch����������ʹ�õĶ˿��޶�Ϊ��9600
# ����ǽ����ģ�廹û�����ݲ�ִ��
