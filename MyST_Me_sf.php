<?php if (empty($_POST)): ?>
<!-- 
Copyright (c) 2014, Hari S. Khalsa
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.

* Neither the name of MyST Me nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
-->
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>MyST Me</title>
</head>
<body onload="setUp()">
<form id="MyST_MeForm" class="model-exporter-form" method="post">
<fieldset>

<legend>MyST ME - MySQL database to Sencha Touch Model Exporter</legend>

  <label class="input-label" for="host">Database host</label>
  <input id="host" name="host" type="text" value="127.0.0.1" class="text-input" required=""><br>

  <label class="input-label" for="userName">Database Username</label>
  <input id="userName" name="userName" type="text" value="root" class="text-input" required=""><br>

  <label class="input-label" for="dbPassword">Database Password</label>
  <input id="dbPassword" name="dbPassword" type="password" value="" class="text-input"><br>

  <label class="input-label" for="databaseName">Database Instance</label>
  <input id="databaseName" name="databaseName" type="text" value="mydb" class="text-input" required=""><br>

  <button type="button" id="getTablesButton" name="getTablesButton" onclick="getTables()">Get Tables</button><br><br>
  
  <!-- User selects DB tables to work with -->
  <div id="dbTableSelction">
    <table cellspacing="0" id="dbTableSelectionTable">
    <tr>
    <th>Database Tables</th>
    <th> </th>
    <th>Database Tables Selected to Export</th>
    </tr>
    <tr>
      <td>
        <div>
            <select id="dbTableValuesLeft" size="7" multiple style="width:200px">
            </select>
        </div>
      </td>
      <td>
        <div>
            <input type="button" id="allRightDbTable" value="&gt;&gt;" /><br>
            <input type="button" id="btnRightDbTable" value="&gt;" /><br>
            <input type="button" id="allLeftDbTable" value="&lt;&lt;" /><br>
            <input type="button" id="btnLeftDbTable" value="&lt;" />
        </div>
      </td>
      <td>
       <div>
           <select name="dbTableValuesRight[]" id="dbTableValuesRight" size="7" multiple style="width:200px">
           </select>
       </div>
      </td>
    </tr>
    </table><br>
  </div>

  <div id="inputExportDirectory">
  </div>
  
  
  <!-- <div id="exportOptions" style="display: none;"> -->
  <div id="exportOptions">
  	<br><button type="button" id="selectAllOptions" name="selectAllOptions" onclick="selectAllNoOptions(this)">Select All Options</button><br>
  	<table cellspacing="0" id="exportOptionsTable" border="1">
  	  <tr>
  	  	<td>
          <input id="presenceValidation" name="presenceValidation" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="presenceValidation">Add presence validation for non-null attributes.</label>
  	  	</td>
  	  	<td>
          <input id="inclusionValidation" name="inclusionValidation" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="inclusionValidation">Add inclusion validation for enum attributes.</label>
  	  	</td>
  	  	<td>
          <input id="maxLengthValidation" name="maxLengthValidation" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="maxLengthValidation">Add maximum length validation for varchar attributes.</label>
  	  	</td>
  	  </tr>
  	  <tr>
  	  	<td>
          <input id="formatValidation" name="formatValidation" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="formatValidation">Add format validation for varchar attributes.</label><br>
  	  	  <label class="input-label" for="regExString">Format Validation Regular expression:</label>
          <input id="regExString" name="regExString" type="text" value="^[A-Za-z0-9 _]*$" class="text-input" disabled>
  	  	</td>
  	  	<td>
          <input id="addIdentifier" name="addIdentifier" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="addIdentifier">Add uuid identifier strategy.</label>
  	  	</td>
  	  	<td>
          <input id="addDefaultValues" name="addDefaultValues" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="addDefaultValues">Add default values for attributes.</label>
  	  	</td>
  	  </tr>
      <tr>
  	  	<td colspan="3">
          <input id="hasMany" name="hasMany" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="hasMany">Add hasMany configuration for attributes that come from foreign key relationships that are not part of the primary key.</label>
  	  	</td>
  	  </tr>
  	  <tr>
  	  	<td colspan="2">
          <input id="belongsTo" name="belongsTo" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="belongsTo">Add belongsTo configuration for tables related to only one other table.</label><br>
  	  	</td>
  	  	<td>
          <input id="idProperty" name="idProperty" type="checkbox" class="checkbox-input">
  	  	  <label class="input-label" for="idProperty">Add idProperty for primary key.</label>
  	  	</td>
  	  </tr>
    </table>
  </div>
  <br>
  <table cellspacing="0" id="spaceOptionsTable">
  	<tr>
  	  <td>
  	  	<input type="radio" name="radios" id="useTab" value="useTab" class="radio-input">
  	  	<label class="input-label" for="useTab">Use tabs at begining of line.</label>
  	  	<input type="radio" name="radios" id="useSpaces" value="useSpaces" checked="checked" class="radio-input">
  	  	<label class="input-label" for="useSpaces">Use sapces at begining of line.</label>
  	  </td>
  	</tr>
  	<tr>
  	  <td>
  	  	<label class="input-label" for="numberOfSpaces">Number of spaces to use:</label>
        <input id="numberOfSpaces" name="numberOfSpaces" type="text" value="2" class="text-input">
  	  </td>
  	</tr>
  </table>
  
  <br><label class="input-label" for="projectName" >Enter the project name:</label>
  <!-- <input id="projectName" type="text" class="text-input" required=""> -->
  <!-- CHANGE ME LATER -->
  <input id="projectName" type="text" name="projectName" class="text-input" required="" value="BVA">
  <!-- <br><button id="exportModel" name="exportModel">Export Models</button><br> -->
  <br><input id="submit" type="submit" value="Export Models" onclick="submitTables()"><br>

</fieldset>
</form>
</body>
<script type="text/javascript">
var mystmeUrl = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>";
function setUp() {
  document.getElementById("MyST_MeForm").action = mystmeUrl;
  setUpExportDirectoryInput();
  setUpArrowButtons();
  setUpRadioButtons();
  document.getElementById("formatValidation").addEventListener("click", 
   function(){document.getElementById("regExString").disabled = !document.getElementById("regExString").disabled;});
  getExportDirectory();
  //DEBUG keep form from submitting to debug javascript
  //document.getElementById('MyST_MeForm').onsubmit = function() {return false;}; 
}

function selectAllNoOptions(selectOptionsButton) {

  var checked = false;
  if (selectOptionsButton.innerHTML === "Select All Options") {
    selectOptionsButton.innerHTML = "Select No Options";
    checked = true;
  }
  else {
    selectOptionsButton.innerHTML = "Select All Options";
  }
	  
  document.getElementById("presenceValidation").checked = checked; 
  document.getElementById("inclusionValidation").checked = checked;
  document.getElementById("maxLengthValidation").checked = checked;
  document.getElementById("formatValidation").checked = checked;
  document.getElementById("addIdentifier").checked = checked;
  document.getElementById("addDefaultValues").checked = checked;
  document.getElementById("hasMany").checked = checked;
  document.getElementById("belongsTo").checked = checked;
  document.getElementById("idProperty").checked = checked;
   
  document.getElementById("regExString").disabled = !checked;
}

function setUpRadioButtons() {
  document.getElementById("useTab").addEventListener("click", 
   function(){document.getElementById("numberOfSpaces").disabled = true;});
  document.getElementById("useSpaces").addEventListener("click", 
   function(){document.getElementById("numberOfSpaces").disabled = false;});
   
}

function setUpExportDirectoryInput() {
	var inputExportDirectory = "";
	//I thought I could offer Chrome users a shortcut to select a folder
	//through a dialog but only the relative paths from the directory
	//chosen are available, so I'm just going to comment out the functionality.
	//if (isChrome()){
	if (false){
	  inputExportDirectory = "<label class=\"input-label\" for=\"exportDirectoryInput\">Select directory for exported files.</label>\n";
      //example of use found here: http://jsfiddle.net/addyo/Ha979/
	  inputExportDirectory += "<input id=\"exportDirectoryInput\" name=\"exportDirectoryInput\" type=\"file\" webkitdirectory directory/>";
	}
	else
	{
	  inputExportDirectory = "<label class=\"input-label\" for=\"exportDirectoryInput\">Enter directory for exported files.</label>\n";
	  inputExportDirectory += "<input id=\"exportDirectoryInput\" name=\"exportDirectoryInput\" type=\"text\" value=\".\"  required=\"\" class=\"text-input\"/>";
	  inputExportDirectory += "<br><label class=\"input-label\" for=\"exportDirectoryInput\">If the directory is set to a value of \".\", the code will look for a \"model\" or \"app/model\" directory underneath current directory</label>\n";
	  
	}
	document.getElementById("inputExportDirectory").innerHTML=inputExportDirectory;
}

function setUpArrowButtons() {
  document.getElementById("btnRightDbTable").addEventListener("click", 
   function(){moveSelectedDbTables(true,false);});
  
  document.getElementById("btnLeftDbTable").addEventListener("click", 
   function(){moveSelectedDbTables(false,false);});
   
  document.getElementById("allRightDbTable").addEventListener("click", 
   function(){moveSelectedDbTables(true,true);});
  
  document.getElementById("allLeftDbTable").addEventListener("click", 
   function(){moveSelectedDbTables(false,true);});
}

function moveSelectedDbTables(right,all)
{
  var fromList, toList;
  if (right) {
    fromList = document.getElementById("dbTableValuesLeft");
    toList = document.getElementById("dbTableValuesRight");
  } else {
    fromList = document.getElementById("dbTableValuesRight");
    toList = document.getElementById("dbTableValuesLeft");
  }
  
  var currentOption;
  //it's important to loop through the options backwards
  for (i = fromList.options.length-1; i >= 0; i--) {
  	currentOption = fromList.options.item(i);
  	if (all || currentOption.selected) {
  	  toList.options.add(currentOption,0);
  	  //console.log(currentOption);
  	  //fromList.remove(i); //you don't need to remove it from one when moving to the other 
  	}
  }
}

function isChrome() {
  return navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
}

function getExportDirectory() {
  var exportDirectoryInput = document.getElementById("exportDirectoryInput").value;  
  var variables = "action=getExportDirectory&exportDirectoryInput=" + exportDirectoryInput;
  
  makeAjaxRequest(getExportDirectoryCallback, mystmeUrl, variables, getExportDirectoryErrorCallback);
}

function getTables() {
  var host = document.getElementById("host").value;
  var databaseName = document.getElementById("databaseName").value;
  var userName = document.getElementById("userName").value;
  var dbPassword = document.getElementById("dbPassword").value;
  //console.log("host: " + host + " databaseName: " + databaseName + " userName: " +  userName + " dbPassword: " +  dbPassword);
  
  var variables = "action=getTables&host=" + host + "&databaseName=" + databaseName + "&userName=" +  userName + "&dbPassword=" +  dbPassword;
  
  if (!host){
  	alert("The host needs to be defined in order to retrieve the tables.");
  	return;
  }
  if (!databaseName){
  	alert("The database needs to be defined in order to retrieve the tables.");
  	return;
  }
  if (!userName){
  	alert("The user name needs to be defined in order to retrieve the tables.");
  	return;
  }
  makeAjaxRequest(getTablesCallback, mystmeUrl, variables, getTablesErrorCallback);
  document.getElementById("getTablesButton").style.visibility="hidden";
}

function makeAjaxRequest(callback, url, variables, errorCallback) {
  var xmlHttp;
  if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlHttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlHttp.onreadystatechange=function() {
    if (xmlHttp.readyState !=4)
      return;
    if (xmlHttp.status==200) {
      callback(xmlHttp.responseText);
      return;
    } 
    if (xmlHttp.status==500) {
      errorCallback(xmlHttp.responseText);
      return;
    }
  };
  
  xmlHttp.open("POST",url,true);
  xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlHttp.send(variables);  
}

function getTablesErrorCallback(data) {
  var parsedData = JSON.parse(data);
  
  alert(parsedData["message"]);
  document.getElementById("getTablesButton").style.visibility="visible";
}

function getTablesCallback(data) {
  //console.log(data);
  var parsedData = JSON.parse(data);
  //console.log(parsedData);
	
  var dbTableValuesLeft = document.getElementById('dbTableValuesLeft');
  for(var i = 0; i < parsedData.length; i++) {
    var option = document.createElement('option');
    option.innerHTML = parsedData[i];
    option.value = parsedData[i];
    dbTableValuesLeft.appendChild(option);
  }
}

function getExportDirectoryErrorCallback(data) {
  var parsedData = JSON.parse(data);
  alert(parsedData["message"]);
}

function getExportDirectoryCallback(data) {
  var parsedData = JSON.parse(data);
  document.getElementById("exportDirectoryInput").value = parsedData;
}

function submitTables(){
  //in order to submit all the chosen tables they need to be selected
  var selectedTablesList = document.getElementById("dbTableValuesRight");
  for (i = 0; i < selectedTablesList.options.length; i++)
  	selectedTablesList.options.item(i).selected = true;
}

</script>
</html>
<?php endif; ?>
<?php

if (isset($_POST["action"])) {
  if ($_POST["action"] == "getTables") {
	//header("content-type:application/json");
	getTables();
	return;
  } elseif ($_POST["action"] == "getDatabases") {
    getDatabases();
  } elseif ($_POST["action"] == "getExportDirectory") {
    $exportDirectory = getModelPath($_POST['exportDirectoryInput']);
    echo json_encode($exportDirectory);
	return;
  }
}
elseif (!empty($_POST)) {
  exportModels();
}

function getDatabases() {
  $databaseConnect = connectToDatabase();
  $res = mysql_query("SHOW DATABASES");

  $databaseArray = array();
  while ($row = mysql_fetch_assoc($res)) {
    $databaseArray[] = $row['Database'];
	//echo $row['Database'] . "\n";
  }
  
  echo json_encode($databaseArray);
}

function getTables() {
	
  // $host = $_POST["host"];
  // $user = $_POST["userName"];
  // $pass = $_POST["dbPassword"];

  //echo "action=getTables&host=" . $host . "&databaseName=" . $database . "&userName=" .  $user . "&dbPassword=" .  $pass;
  
  //connection to the database
  //mysql_connect($host, $user, $pass)
  //or die ('cannot connect to the database: ' . mysql_error());
  
  $errorMessage = connectToDatabase();
  if ($errorMessage != "")
  {
	returnError("Oops you messed up the database parameters.", $errorMessage);
    return; 
  }

  $database = $_POST["databaseName"];
  
  //select the database
  mysql_select_db($database)
   or $errorMessage =  'Cannot select database: ' . mysql_error();
  if ($errorMessage != "")
  {
	returnError("The database, $database, could not be selected.", $errorMessage);
    return; 
  }

  //loop to show all the tables and fields
  $tables = mysql_query("SHOW tables FROM $database")
   or $errorMessage =  'Cannot select tables' . mysql_error();
  if ($errorMessage != "")
  {
	returnError("The tables could not be selected.", $errorMessage);
    return; 
  }
  
  $tableNameArray = array();
  
  while($table = mysql_fetch_array($tables))
  {
  	$tableNameArray[] = $table[0];
  }
  
  echo json_encode($tableNameArray);
}

function connectToDatabase() {
	$connectMessage = "";
	mysql_connect($_POST["host"], $_POST["userName"], $_POST["dbPassword"]) or $connectMessage = 'Could not connect to the database: ' . mysql_error();
	return $connectMessage;
}

function returnError($httpMessage, $errorMessage)
{
  header("HTTP/1.1 500 $httpMessage", true, 500);
  http_response_code(500);
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode(array('message' => "$errorMessage", 'code' => 500));
}

function connectToDatabaseO($host, $user, $pass, $database){
	//connection to the database
  mysql_connect($host, $user, $pass)
  or die ('cannot connect to the database: ' . mysql_error());

  //select the database
  mysql_select_db($database)
  or die ('cannot select database: ' . mysql_error());
}


function exportModels() {
	    
  if (!isset($_POST['dbTableValuesRight'])) {
    echo "<br>No tables selected<br>";
    return;
  }
  
  $dbTables = $_POST['dbTableValuesRight'];
  
  $exportDirectory = getModelPath($_POST['exportDirectoryInput']);
  $space = getSpaces();
  
  $hasMany = false;
  
  if (isset($_POST['hasMany']))
    $hasMany = true; 
  
  //connectToDatabase($_POST["host"], $_POST["userName"], $_POST["dbPassword"],
  // $_POST["databaseName"]);
   
  connectToDatabase();
  $database = $_POST["databaseName"];
  mysql_select_db($database)
   or die ('Cannot select database: ' . mysql_error());
  
  $tableAttributes = getTableAttributes($dbTables);
  $belongsTo = getBelongsToArray($tableAttributes);
  
  foreach ($tableAttributes as $table => $attributes) {
	$fileContents = getIdentifier($space);
	$fileContents = $fileContents.getFields($attributes, $space);
	$fileContents = $fileContents.getIdProperty($attributes, $space);
    $fileContents = $fileContents.getBelongsTo($belongsTo, $table, $space);
	$fileContents = $fileContents.getValidations($attributes, $space);
    $fileContents = $fileContents.getHasMany($attributes, $space);
    
	//replace the last comma with a space
    $fileContents[strrpos($fileContents, ",")] = " ";
	
    writeModelFile($table, $exportDirectory, $fileContents, $space);
  }
   
}

function writeModelFile($table, $exportDirectory, $fileContents, $space) {
  
  $table = strtolower($table);
  $modelFile = $table.".js";
  $fileHandle = fopen($exportDirectory . DIRECTORY_SEPARATOR . $modelFile, 'w') or die("can't open file");

  $table = ucfirst($table);  
  $stringData = "Ext.define('".$_POST['projectName'].".model.". $table ."', {\n";
  $stringData = $stringData.$space."extend: 'Ext.data.Model',\n".$space."config: {\n";
  fwrite($fileHandle, $stringData);

  echo "<pre>$stringData$fileContents$space}\n});</pre>";//debug
  fwrite($fileHandle, $fileContents);

  fwrite($fileHandle, $space."}\n});");
  fclose($fileHandle);
}

function getBelongsTo($belongsTo, $table, $space){
  $stringData = "";
  
  if(!isset($_POST['belongsTo']))
    return $stringData;
  
  if (!in_array($table,$belongsTo))
    return $stringData; 
  
  if (count($belongsTo[$table]) != 1)
    return $stringData; 
  
  $fkTable = ucfirst(strtolower($attributes[$i]->getforeignKeyColumn()));
  $stringData = $space.$space."belongsTo: '$fkTable',\n";
  
  return $stringData;
}

function getIdProperty($attributes, $space) {
  $stringData = "";
  if(!isset($_POST['idProperty']))
    return "";
  $i = 0;
  for ($i=0; $i < count($attributes); $i++) {
  	if(!$attributes[$i]->isPrimaryKey()) 
  	  continue;
    $stringData = $stringData.$space.$space."idProperty: '".$attributes[$i]->
     getName()."',\n";
  }
  return $stringData;
}

function getHasMany($attributes, $space){
  $stringData = "";
  
  if(!isset($_POST['hasMany']))
    return $stringData;
  
  $i = 0;
  for ($i=0; $i < count($attributes); $i++) {
  	//skip attributes that define foreign key relationships
  	if(!$attributes[$i]->isForeignKey())
	  continue;
	//if ($attributes[$i]->isPrimaryKey()) 
  	//  continue;
    $fkTable = ucfirst(strtolower($attributes[$i]->getforeignKeyTable()));
    $stringData = $stringData.$space.$space."hasMany:{ model: '$fkTable', name: '".
     $attributes[$i]->getName()."'},\n";
  }
  
  return $stringData;
}

function getValidations($attributes, $space) {
  $stringData = $space.$space."validations:\n".$space.$space."[\n";
  
  $i = 0;
  for ($i=0; $i < count($attributes); $i++) {
  	//skip attributes that define foreign key relationships
  	if(isset($_POST['hasMany']) && $attributes[$i]->isForeignKey() && !$attributes[$i]->isPrimaryKey()) 
  	  continue;
	
	/*
  $hasMany = false;
	 */
    $stringData = $stringData.getPresenceValidation($attributes[$i], $space);
    $stringData = $stringData.getMaxLengthValidation($attributes[$i], $space);
    $stringData = $stringData.getFormatValidation($attributes[$i], $space);
    $stringData = $stringData.getInclusionValidation($attributes[$i], $space);  
  }
  
  //replace the last comma with a space
  if (strpos($stringData, ",") != false)
    $stringData[strrpos($stringData, ",")] = " ";
  $stringData = $stringData.$space.$space."],\n";
  
  return $stringData;
}

function getPresenceValidation($attribute, $space){
  if (!isset($_POST['presenceValidation'])) 
    return "";
  if ($attribute->canBeNull())
    return "";
  $stringData = $space.$space.$space."{type: 'presence', field: '".
   $attribute->getName()."'},\n";
  return $stringData;
}

function getMaxLengthValidation($attribute, $space){
  if (!isset($_POST['maxLengthValidation']) || $attribute->getModelType()
   != "string" || $attribute->isEnum())
    return "";
  $maxLength = $attribute->getMaxLength();
  if ($maxLength == null)
    return "";
  $stringData = $space.$space.$space."{type: 'length', field: '".
   $attribute->getName()."', max:$maxLength},\n";
  return $stringData;
}
function getFormatValidation($attribute, $space){
  if (!isset($_POST['formatValidation']) || $attribute->getModelType() 
   != "string" || $attribute->isEnum()) 
    return "";
  $regExString = $_POST['regExString'];
  $stringData = $space.$space.$space."{type: 'format', field: '".
   $attribute->getName()."', matcher:/$regExString/},\n";
  return $stringData;
}
function getInclusionValidation($attribute, $space){
  if (!isset($_POST['inclusionValidation'])) 
    return "";
  $values = $attribute->getEnumValues();
  if ($values == null)
    return "";
  $stringData = $space.$space.$space."{type: 'inclusion', field: '".
   $attribute->getName()."', list: [$values]},\n";
  return $stringData;
}

function getIdentifier($space) {
  if (isset($_POST['addIdentifier']))
    return $space.$space."identifier: 'uuid',\n";
  return "";
}

function getFields($attributes, $space) {
  $stringData = $space.$space."fields:\n".$space.$space."[\n";
  
  $i = 0;
  for ($i=0; $i < count($attributes); $i++) {
  	//skip attributes that define foreign key relationships
  	if(isset($_POST['hasMany']) && $attributes[$i]->isForeignKey() && !$attributes[$i]->isPrimaryKey()) 
  	  continue;
    $stringData = $stringData.$space.$space.$space."{name: '".$attributes[$i]->
     getName()."', type: '".$attributes[$i]->getModelType()."'";
	if (isset($_POST['addDefaultValues']) && $attributes[$i]->getDefaultValue() != null)
      $stringData = $stringData.", defaultValue: ".$attributes[$i]->getDefaultValue();
    $stringData = $stringData."}, //".$attributes[$i]->getType()."\n";
  }
  
  //replace the last comma with a space
  $stringData[strrpos($stringData, ",")] = " ";
  $stringData = $stringData.$space.$space."],\n";
  
  return $stringData;
}

function getBelongsToArray($tableAttributes) {
  $belongsTo = array();
  
  foreach ($tableAttributes as $table => $attributes) {
    foreach ($attributes as $attribute) {
      if ($attribute->getForeignKeyTable() != null) {
        if (!in_array($attribute->getForeignKeyTable(),$belongsTo)) 
          $belongsTo[$attribute->getForeignKeyTable()] = array();
	    if (!in_array($table, $belongsTo[$attribute->getForeignKeyTable()]))
          array_push($belongsTo[$attribute->getForeignKeyTable()], $table);
      }
    }
  }
  return $belongsTo;
}

function getTableAttributes($dbTables){
      
  $tableAttributes = array();
  $currentDbAttributes;
  
  foreach ($dbTables as $dbTable) {
    $attributes = array();
    $row = mysql_query("SHOW columns FROM " . $dbTable) or die ('cannot select table fields') . mysql_error();
  
    //echo "<br>Table: ".$dbTable; //debug
    
    $foreignKeyAttributes = getForeignKeyAttributes($dbTable);
  
    while ($col = mysql_fetch_array($row))
    {
      if (key_exists($col[0], $foreignKeyAttributes)) 
        $currentDbAttributes = new DbAttribute($col[0], $col[1], $col[2], $col[3], $col[4],$foreignKeyAttributes[$col[0]]["foreign_table"],$foreignKeyAttributes[$col[0]]["foreign_column"]);
      else
        $currentDbAttributes = new DbAttribute($col[0], $col[1], $col[2], $col[3], $col[4],null,null);
	
	  //	echo "<br>".$currentDbAttributes->toString(); //debug
	  array_push($attributes,$currentDbAttributes);  
    }
    $tableAttributes[$dbTable] = $attributes;
      
  }
  return $tableAttributes;
}

function getForeignKeyAttributes($dbTable) {
  $selectForeignKey = <<<EOS
	SELECT
    `column_name`, 
    `referenced_table_schema` AS foreign_db, 
    `referenced_table_name` AS foreign_table, 
    `referenced_column_name`  AS foreign_column 
    FROM
    `information_schema`.`KEY_COLUMN_USAGE`
    WHERE
    `constraint_schema` = SCHEMA()
    AND
    `table_name` = '$dbTable'
    AND
    `referenced_column_name` IS NOT NULL
    ORDER BY
    `column_name`;
EOS;
	
	$foreignKeyAttributes = array();
	
	$row = mysql_query($selectForeignKey) or die ('cannot select table fields');
	
	
    while ($col = mysql_fetch_assoc($row))
    {
	  $foreignKey = array("foreign_table" => $col["foreign_table"], "foreign_column" => $col["foreign_column"]);
	  $foreignKeyAttributes[$col["column_name"]] = $foreignKey;
    }
    //echo "<br>"; echo var_dump($foreignKeyAttributes); //debug
	return $foreignKeyAttributes; 
}

function getSpaces() {
  $isSpace = $_POST['radios'];
  $space = "\t";
  $numberOfSpaces = 4;
  if ($isSpace != 'useSpaces') {
  	return $space;
  }
  if (isset($_POST['numberOfSpaces'])) {
    $numberOfSpaces = $_POST['numberOfSpaces'];
  if ($numberOfSpaces == "")
	  $numberOfSpaces = 4;
  }
  
  $space = "";
  for ($i=0; $i < $numberOfSpaces; $i++) { 
    $space = $space." ";
  }
      
  //echo "<br>isSpace: " . $isSpace . " number of spaces: " . $numberOfSpaces . " <pre>sp".$space."ace</pre>";	//debug
  return $space;
}

function getModelPath($exportDirectory) {
  if ($exportDirectory != ".")
    return realpath($exportDirectory);
  $exportDirectory = realpath(dirname(__FILE__));
  if (is_dir($exportDirectory . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "model"))
    $exportDirectory = $exportDirectory . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "model";
  if (is_dir($exportDirectory . DIRECTORY_SEPARATOR . "model"))
    $exportDirectory = $exportDirectory . DIRECTORY_SEPARATOR . "model";
  // echo "<br>directory: " . $exportDirectory . "\n"; //debug
  return $exportDirectory;
}

//*
class DbAttribute {
  private $name;
  private $type;
  private $canBeNull = false;
  private $isForeignKey = false;
  private $isPrimaryKey = false;
  private $foreignKeyTable = null;
  private $foreignKeyColumn = null;
  private $defaultValue = null;
  private $dbType= null; 
  
  function __construct($name, $type, $nullAllowed, $key, $defaultValue, $foreignKeyTable, $foreignKeyColumn) {
    $this->name = $name;
    $this->type = strtolower($type);
	if (strcasecmp ($nullAllowed,"YES")==0)
      $this->canBeNull = true;
	//if (strcasecmp ($key,"MUL")==0) //didn't work
	if($foreignKeyTable != null && $foreignKeyColumn != null)
	  $this->isForeignKey = true;
	if (strcasecmp ($key,"PRI")==0)
	  $this->isPrimaryKey = true;
	$this->foreignKeyTable = $foreignKeyTable;
	$this->foreignKeyColumn = $foreignKeyColumn;
	$this->defaultValue = $this->formatDefaultValue($defaultValue);
  }
  
  public function getType() {return $this->type; }
  public function getName() {return $this->name;}
  public function canBeNull() {return $this->canBeNull;}
  public function isForeignKey() {return $this->isForeignKey;}
  public function getForeignKeyTable() {return $this->foreignKeyTable;}
  public function getDefaultValue() {return $this->defaultValue;}
  public function isPrimaryKey() {return $this->isPrimaryKey;}
  public function getforeignKeyColumn() {return $this->foreignKeyColumn;}
    
  public function getModelType(){
  	if (!is_null($this->dbType))
	  return $this->dbType;
    
	if (strripos($this->type, "char") !== false || strripos($this->type, "text") !== false || strripos($this->type, "enum") !== false)
	{
      $this->dbType = "string";
	} else if (strripos($this->type, "decimal") !== false || strripos($this->type, "numeric") !== false || strripos($this->type, "float") !== false || strripos($this->type, "double") !== false) {
		$this->dbType = "float";
    } else if (strripos($this->type, "bool") !== false) {
      $this->dbType = "boolean";
	} else if (strripos($this->type, "int") !== false || strripos($this->type, "long") !== false) {
	  $this->dbType = "int";
	} else if (strripos($this->type, "date") !== false || strripos($this->type, "time") !== false) {
	  $this->dbType = "date";
	} else {
	  $this->dbType = "auto";
	}
	  
	return $this->dbType;
  }
  
  private function formatDefaultValue($defaultValue) {
  	if ($defaultValue == "") 
	  return null;
	if ($this->getModelType() == "boolean")
	  if ($defaultValue == 1)
	    $defaultValue = "true";
	  else
	    $defaultValue = "false";
	elseif ($this->getModelType() == "string")
      $defaultValue = "'$defaultValue'";
	
	return $defaultValue;	
  }
  
  public function isEnum() {
  	if (strripos($this->type, "enum") === false)
	  return false;
	return true;
  }
  
  /** If the attribute type is an enumerated type return a string of its values,
   * return null otherwise.
   */
  public function getEnumValues() {
  	if (!$this->isEnum())
	  return null;
	$type = str_ireplace("enum(", "", $this->type);
	$type = str_ireplace(")", "", $type);
	return $type;
	//$values = str_getcsv($type);
	//return $values;
  }
  
  /**If the attribute type is string return the max length of the string,
   * return null otherwise.
   */
  public function getMaxLength() {
    if ($this->getModelType() != "string")
	  return null;
	if (strpos($this->getType(), "(") == false)
	  return null;
	$maxLength = substr($this->getType(), strpos($this->getType(), "(")+1, strpos($this->getType(), ")")-1 - strpos($this->getType(), "("));
	return $maxLength;
  }
  
  public function toString() {
  	$canBeNull = $this->canBeNull?"true":"false";
	$isForeignKey = $this->isForeignKey?"true":"false";
	$isPrimaryKey = $this->isPrimaryKey?"true":"false";
  	return "Name: ".$this->name . " Type: " . $this->type . " Model Type: ".
  	 $this->getModelType(). " Can Be Null: " . $canBeNull." Is Primary Key: ".
  	 $isPrimaryKey." Is Foreign Key: ". $isForeignKey." Foreign Key Table: " .
  	 $this->foreignKeyTable." Foreign Key Column: ".$this->foreignKeyColumn.
  	 " Default Value: ". $this->defaultValue;
  }
   
}
 
 //*/

?>