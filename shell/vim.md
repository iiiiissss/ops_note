:lvim /\<\(name\)\>/gj *.txt
:lw

:lvim name *.py

替换:
:s/vivian/sky/ 替换当前行第一个 vivian 为 sky 
:s/vivian/sky/g 替换当前行所有 vivian 为 sky 
:%s/vivian/sky/（等同于 :g/vivian/s//sky/） 替换每一行的第一个 vivian 为 sky 

C^Z 挂起 jobs展示  fg num 选择

vi模式下 
:!  shell模式
:e ./xx.sh  打开       C^O 回去
:buffers
:b2 b3 选择

:tabnew
:tabnext
:tabpre

tmux

