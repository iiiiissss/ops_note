


2,此时会有一个选项：Advanced Options for Ubuntu, 选中直接回
3. 看到里面有很多选项，选中后面带recovery mode的选项（千万别回车！），按下字母e，如下图：
4.关键的时候到了， 倒数第四行，会看到一行linux /boot/vm.......ro recovery \nomodeset，
step 1: 删除recovery \nomodeset
step 2: 在这行的最后添加 quiet splash rw init=/bin/bash(删除到ro,并加入quiet splash rw init=/bin/bash:ro quiet splash rw init=/bin/bash  经测试有用 )
5. 按F10, 启动。
6. 如果没有意外你会进入系统， 输入：passwd, 系统会提示你输入新的密码，结束。