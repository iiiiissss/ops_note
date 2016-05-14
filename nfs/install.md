server:

sudo apt-get install nfs-kernel-server
Configuration
vim /etc/exports
/www	 *(ro,sync,no_root_squash)
/home    *(rw,sync,no_root_squash)
/export       192.168.1.0/24(rw,fsid=0,insecure,no_subtree_check,async)
/export/users 192.168.1.0/24(rw,nohide,insecure,no_subtree_check,async)
			
To start the NFS server
service nfs-kernel-server status
sudo /etc/init.d/nfs-kernel-server start


NFSv4 client

sudo apt-get install nfs-common
NFSv3
sudo mount example.hostname.com:/www /www		
NFSv4
# mount -t nfs4 -o proto=tcp,port=2049 nfs-server:/ /mnt
# mount -t nfs4 -o proto=tcp,port=2049 nfs-server:/users /home/users		
NFS Client Configuration
vim /etc/fstab
example.hostname.com:/ubuntu /local/ubuntu nfs rsize=8192,wsize=8192,timeo=14,intr



sudo mount -t nfs4 -o proto=tcp,port=2049 test1:/data/nfs /mnt/nfs/test1
mount.nfs4: Protocol not supported
