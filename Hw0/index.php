<!DOCTYPE html>
<html>
<head>
<style>
	canvas {
		position: fixed;
		top: 0;
		left: 0;
	}
</style>
</head>

<body>
<script src="http://cdnjs.cloudflare.com/ajax/libs/three.js/r70/three.min.js"></script>
<script src="https://dl.dropboxusercontent.com/u/3587259/Code/Threejs/OrbitControls.js">
</script>

<script>

var scene, renderer, camera;
var cube;
var controls

init();
animate();

function init()
{
	renderer = new THREE.WebGLRenderer( {antialias:true} );
	var width = window.innerWidth;
	var height = window.innerHeight;
	renderer.setSize (width, height);
	document.body.appendChild (renderer.domElement);

	scene = new THREE.Scene();
	
	var cubeGeometry = new THREE.BoxGeometry (10,10,10);
	var cubeMaterial = new THREE.MeshLambertMaterial ({color: 0x1ec876});
	cube = new THREE.Mesh (cubeGeometry, cubeMaterial);

	cube.position.set (50, 0, 0);
	scene.add (cube);

	camera = new THREE.PerspectiveCamera (45, width/height, 1, 10000);
	camera.position.y = 160;
	camera.position.z = 400;
	camera.lookAt (new THREE.Vector3(0,0,0));

	// FLOOR
	var floorTexture = new THREE.ImageUtils.loadTexture( '../images/UI4A33.jpg' );
	floorTexture.wrapS = floorTexture.wrapT = THREE.RepeatWrapping; 
	floorTexture.repeat.set( 4, 4 );
	var floorMaterial = new THREE.MeshBasicMaterial( { map: floorTexture, side: THREE.DoubleSide } );
	
	var floorGeometry = new THREE.PlaneGeometry(500, 500);//, 10, 10);  // not clear what segment does
	var floor = new THREE.Mesh(floorGeometry, floorMaterial);
	floor.position.y = -0.5;
	floor.rotation.x = Math.PI / 2;
	scene.add(floor);
/*
	var gridXZ = new THREE.GridHelper(100, 10);
	gridXZ.setColors( new THREE.Color(0xff0000), new THREE.Color(0xffffff) );
	scene.add(gridXZ);
*/
	var pointLight = new THREE.PointLight (0xffffff);
	pointLight.position.set (0,300,200);
	scene.add (pointLight);
	
	window.addEventListener ('resize', onWindowResize, false);
}

function onWindowResize ()
{
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize (window.innerWidth, window.innerHeight);
}

function animate()
{
	requestAnimationFrame ( animate );  
	renderer.render (scene, camera);
}



</script>
</body>

</html>