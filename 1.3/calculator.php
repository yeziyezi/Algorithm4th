<?php

//用两个栈实现对算术表达式的计算
//除了sqrt以外 不能省略括号
echo stackCalculator('((2+sqrt(4*4)*3))'),"\n";

class Stack{
    private $data=[];
    private $top=-1;//init empty stack
    public function push($in){
        $this->data[++$this->top]=$in;
        echo 'push ',$in,"\n";
    }
    public function pop(){
        $r=$this->data[$this->top];
        unset($this->data[$this->top]);
        --$this->top;
        echo 'pop ',$r,"\n";
        return $r;
    }
}

function stackCalculator($str){
    $symbols=new Stack();
    $nums=new Stack();
    $elements=dealExpression($str);
    foreach($elements as $element){
        switch($element){
        case '+':
        case '-':
        case '*':
        case '/':
        case 'sqrt':
                $symbols->push($element);
                break;
        case '(':break;
        case ')':$s=$symbols->pop();
                 $right=$nums->pop();//右操作数
                 $left=$nums->pop();//左操作数
                 $r=0;//计算结果
                 switch($s){
                 case '+':$r=$left+$right;break;
                 case '-':$r=$left-$right;break;
                 case '*':$r=$left*$right;break;
                 case '/':$r=$left/$right;break;
                 //如果是开方操作，只需要取一个操作数，将多取出的数放回去
                 case 'sqrt':$nums->push($left);$r=sqrt($right);break;
                 }
                 $nums->push($r);
                 break;
        default: $nums->push($element);
        }
    }
    return $nums->pop();
}
//将算数表达式分解为元素数组
function dealExpression($str){
    $result=[];
    $arr=str_split($str);
    $num_buf=[];
    $sqrt_start=false;
    foreach($arr as $c){
        switch($c){
            
            case '+':
            case '-':
            case '*':
            case '/':
            case '(':
            case ')':
                    if(!empty($num_buf)){
                        $result[]=implode("",$num_buf);
                        $num_buf=[];
                    }
                    if($c==')'){
                        if($sqrt_start)$result[]=')';//补齐sqrt的右括号
                        $sqrt_start=false;
                    }
                    $result[]=$c;
                    break;
            case 's':break;
            case 'q':break;
            case 'r':break;
            case 't':
                    $result[]='sqrt';
                    $result[]='(';
                    $sqrt_start=true;
                    break;
            default:$num_buf[]=$c;
        }
    }
    if(!empty($num_buf)){
        $result[]=implode("",$num_buf);
        $num_buf=[];
    }    
    echo implode("",$result),"\n";
    return $result;
}
