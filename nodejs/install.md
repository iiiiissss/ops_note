
nodejs:
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
sudo apt-get install -y nodejs build-essential

sudo npm install -y -g pm2 mysql redis express 


npm install <name> --save  安装的同时，将信息写入package.json中
项目路径中如果有package.json文件时，直接使用npm install方法就可以根据dependencies配置安装所有的依赖包
这样代码提交到github时，就不用提交node_modules这个文件夹了。
npm init 会引导你创建一个package.json文件，包括名称、版本、作者这些信息等
npm remove <name>移除
npm update <name>更新
npm ls 列出当前安装的了所有包
npm root查看当前包的安装路径
npm root -g  查看全局的包的安装路径
npm help 帮助，如果要单独查看install命令的帮助，可以使用的npm help install