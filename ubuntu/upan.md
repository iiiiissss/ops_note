sudo fdisk -l ����ʾȫ���̵���Ϣ
sudo mount -t ntfs-3g /dev/sdb1 /mnt/windows/u


����ʹ�õ���FAT32��ʽ�ģ�
sudo mount -t vfat /dev/sdb1 /mnt/u                (��������mntĿ¼�½�һ����Ϊu���ļ���)
Ȼ��Ϳ���ͨ�� cd /mnt/u ��U���ϵ����ݽ��з����ˡ�
ж��ʱ�ã�
sudo umount /mnt/u 
��ж��ʱ������device is busy�����������
mount -l /mnt/u
��ж���豸��ѡ�� �Cl ����������umount�������ڸ�Ŀ¼���к���umount��Ҳ�������� ps aux �鿴ռ���豸�ĳ���PID��Ȼ��kill PID�����umount�ͷǳ������ˡ�


��ʹ��cp�����ļ�����ʹ��-rѡ�

CP���� 
��ʽ: CP [ѡ��] Դ�ļ���Ŀ¼ Ŀ���ļ���Ŀ¼ 
ѡ��˵��:-b ͬ��,����ԭ�����ļ� 
-f ǿ�Ƹ���ͬ���ļ� 
-r ���ݹ鷽ʽ����ԭĿ¼�ṹ�����ļ� 

cp -r /tmp/a /root/a