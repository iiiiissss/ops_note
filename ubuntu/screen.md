detached

screen -ls

������ʾ��ǰ����������detached״̬��screen�Ự�������ʹ��screen -r <screen_pid>���������ϣ�
[root@tivf18 root]# screen �Cls
There are screens on:
        8736.pts-1.tivf18       (Detached)
        8462.pts-0.tivf18       (Detached)
2 Sockets in /root/.screen.
[root@tivf18 root]# screen �Cr 8736



C-a ?	��ʾ���м�����Ϣ
C-a w	��ʾ���д����б�
C-a C-a	�л���֮ǰ��ʾ�Ĵ���
C-a c	����һ���µ�����shell�Ĵ��ڲ��л����ô���
C-a n	�л�����һ������
C-a p	�л���ǰһ������(��C-a n���)
C-a 0..9	�л�������0..9
C-a a	���� C-a����ǰ����
C-a d	��ʱ�Ͽ�screen�Ự
C-a k	ɱ����ǰ����
C-a [	���뿽��/�ع�ģʽ

-c file	ʹ�������ļ�file������ʹ��Ĭ�ϵ�$HOME/.screenrc
-d|-D [pid.tty.host]	�������µ�screen�Ự�����ǶϿ������������е�screen�Ự
-h num	ָ����ʷ�ع���������СΪnum��
-list|-ls	�г�����screen�Ự����ʽΪpid.tty.host
-d -m	����һ����ʼ�ʹ��ڶϿ�ģʽ�ĻỰ
-r sessionowner/ [pid.tty.host]	��������һ���Ͽ��ĻỰ�����û�ģʽ�����ӵ������û�screen�Ự��Ҫָ��sessionowner����Ҫsetuid-rootȨ��
-S sessionname	����screen�ỰʱΪ�Ựָ��һ������
-v	��ʾscreen�汾��Ϣ
-wipe [match]	ͬ-list����ɾ����Щ�޷����ӵĻỰ