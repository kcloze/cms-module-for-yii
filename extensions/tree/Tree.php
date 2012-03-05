<?php
/** 
 * author: askie 
 * blog: http://www.pkphp.com 
 * 版权： 随便用 
 * 无限分类 
 */
class Tree {
	public $data = array ();
	public $cateArray = array ();
	
	/*function Tree($data,$cateArray) {
	 $this->date=$data;
	  $this->cateArray=$cateArray;
	}*/
    function Tree() {
	}
	function setNode($id, $parent, $value) {
		$parent = $parent ? $parent : 0;
		$this->data [$id] = $value;
		$this->cateArray [$id] = $parent;
	}
	function getChildsTree($id = 0) {
		$childs = array ();
		foreach ( $this->cateArray as $child => $parent ) {
			if ($parent == $id) {
				$childs [$child] = $this->getChildsTree ( $child );
			}
		
		}
		return $childs;
	}
	function getChilds($id = 0) {
		$childArray = array ();
		$childs = $this->getChild ( $id );
		foreach ( $childs as $child ) {
			$childArray [] = $child;
			$childArray = array_merge ( $childArray, $this->getChilds ( $child ) );
		}
		return $childArray;
	}
	function getChild($id) {
		$childs = array ();
		foreach ( $this->cateArray as $child => $parent ) {
			if ($parent == $id) {
				$childs [$child] = $child;
			}
		}
		return $childs;
	}
	//单线获取父节点 
	function getNodeLever($id) {
		$parents = array ();
		if (key_exists ( $this->cateArray [$id], $this->cateArray )) {
			$parents [] = $this->cateArray [$id];
			$parents = array_merge ( $parents, $this->getNodeLever ( $this->cateArray [$id] ) );
		}
		return $parents;
	}
	function getLayer($id, $preStr = '|-') {
		return str_repeat ( $preStr, count ( $this->getNodeLever ( $id ) ) );
	}
	function getValue($id) {
		return $this->data [$id];
	} // end func 
}

/*$Tree = new Tree(\"请选择分类\"); 
//setNode(目录ID,上级ID，目录名字); 
$Tree->setNode(1, 0, '目录1'); 
$Tree->setNode(2, 1, '目录2'); 
$Tree->setNode(5, 3, '目录5'); 
$Tree->setNode(3, 0, '目录3'); 
$Tree->setNode(4, 2, '目录4'); 
$Tree->setNode(9, 4, '目录9'); 
$Tree->setNode(6, 2, '目录6'); 
$Tree->setNode(7, 2, '目录7'); 
$Tree->setNode(8, 3, '目录8'); 

//print_r($Tree->getChildsTree(0)); 
//print_r($Tree->getChild(0)); 
//print_r($Tree->getLayer(2)); 

$category = $Tree->getChilds(); 

//遍历输出 
foreach ($category as $key=>$id) 
{ 
echo $id.$Tree->getLayer($id, '|-').$Tree->getValue($id).\"\n\"; 
}*/

?> 
