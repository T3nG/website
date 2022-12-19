function loadXMLDoc(){
            if (window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }
            else{
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function(){
                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                     xmlDoc = xmlhttp.responseXML;
                     var h2 = document.getElementById('h2');
                     nodes = xmlDoc.getElementsByTagName("time");
                     t = nodes[0].firstChild.nodeValue;
                     h2.innerHTML = "現在時間(UTC+8): "+t;
                 }
            }
            xmlhttp.open("GET", "../php/show_date.php" ,true);
            xmlhttp.send();
       }
loadXMLDoc();
setInterval(loadXMLDoc, 1000);