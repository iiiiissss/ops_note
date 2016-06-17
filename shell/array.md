#arr=("127.0.0.1" "127.0.0.2" "127.0.0.3")
arr=("127.0.0.1")

for i in "${!arr[@]}"; do 
    printf "%s\t%s\n" "$i" "${arr[$i]}"
done