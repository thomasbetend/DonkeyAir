
<?
include "../../../gen/config.php";
include "../../../gen/common/interface.func.php";
include "../../../gen/common/update.func.php";

/* $app=get_app();
$db=exo_connect();

$valid=validate_session('client'); */

if(!$valid['valid']){

	if($sess_type=='client' ){

		exo_redirect('blank.php');

	}else{

		$_SESSION['err']=$valid['reason'];

		//backtologin('err');

	}

}

function week_number($date, $year){
    if($year)$date=$year.'-'.substr($date,6);
    
    $duedt = explode("-", $date);
    $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
    $week  = (int)date('W', $date);
    return $week;
    }

function difference_in_week($date1,$date2,$year){
    if($year)$date2=$year.'-'.substr($date2,6);
    $duedt1 = explode("-", $date1);
    $date1  = mktime(0, 0, 0, $duedt1[1], $duedt1[2], $duedt1[0]);
//    echo "date1".$date1."<br>";
    $day_of_week1  = (int)date('w', $date1);
  //  echo "day of week 1 : ".$day_of_week1."<br>";
   // echo "modified date 1 : ".date('Y-m-d',$date1-$day_of_week1*24*3600)."<br>";
    
    $duedt2 = explode("-", $date2);
    $date2  = mktime(0, 0, 0, $duedt2[1], $duedt2[2], $duedt2[0]);
    //echo "date2".$date2."<br>";
    $day_of_week2  = (int)date('w', $date2);
    //echo "day of week 2".$day_of_week2."<br>";
    //echo "modified date 2 : ".date('Y-m-d',$date2-$day_of_week2*24*3600)."<br>";
    $nbweek=(int)((7200+$date1-($day_of_week1-1)*24*3600-$date2+($day_of_week2-1)*24*3600)/(24*3600*7));
    //echo "number of weeks".$nbweek."<br>";
    return $nbweek;
    }

    
$today=date("Y-m-d");
    $array=split( "-",$today);
    $current_year=$array[0];
    $current_month=$array[1];
	$current_day=$array[2];


if($sess_type!='client' && $sess_type!='enterprise'){
	
if(!$sess_cid){
$URL_agenda="agendav2/agenda/multi_agendaJX.php";

	}else{
$URL_agenda="agendav2/agenda/AgendaJourJX.php";

$rs=exo_query("SELECT * FROM module,REL_module_client WHERE REL_module_client.FK_module=module.ID AND REL_module_client.FK_client='$sess_cid'");

while($row=exo_fetch_array($rs)){

if (strpos($row['label'], "genda")== true){
	$URL_agenda=$row['URL_assist'];
	}
}
}
}else{
	
if($sess_cid=='0'){
$URL_agenda="agendav2/agenda/multi_agenda.php";
	}else{
$URL_agenda="agendav2/agenda/AgendaJour.php";

$rs=exo_query("SELECT * FROM module,REL_module_client WHERE REL_module_client.FK_module=module.ID AND REL_module_client.FK_client='$sess_cid'");

while($row=exo_fetch_array($rs)){

if (strpos($row['label'], "genda")== true){
	$URL_agenda=$row['URL_assist'];
	}
}
}
	
	
}



class Calendar
{
    /*
        Constructor for the Calendar class
    */
    function Calendar()
    {
    }
    
    
    /*
        Get the array of strings used to label the days of the week. This array contains seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function getDayNames()
    {
        return $this->dayNames;
    }
    

    /*
        Set the array of strings used to label the days of the week. This array must contain seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function setDayNames($names)
    {
        $this->dayNames = $names;
    }
    
    /*
        Get the array of strings used to label the months of the year. This array contains twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function getMonthNames()
    {
        return $this->monthNames;
    }
    
    /*
        Set the array of strings used to label the months of the year. This array must contain twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function setMonthNames($names)
    {
        $this->monthNames = $names;
    }
    
    
    
    /* 
        Gets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
      function getStartDay()
    {
        return $this->startDay;
    }
    
    /* 
        Sets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    function setStartDay($day)
    {
        $this->startDay = $day;
    }
    
    
    /* 
        Gets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function getStartMonth()
    {
        return $this->startMonth;
    }
    
    /* 
        Sets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function setStartMonth($month)
    {
        $this->startMonth = $month;
    }
    
    
    /*
        Return the URL to link to in order to display a calendar for a given month/year.
        You must override this method if you want to activate the "forward" and "back" 
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
        
        If the calendar is being displayed in "year" view, $month will be set to zero.
    */
    function getCalendarLink($month, $year)
    {
        return "Calendar.php?month=$month&year=$year";
    }
    
    /*
        Return the URL to link to  for a given date.
        You must override this method if you want to activate the date linking
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
    */
    function getDateLink($day, $month, $year)
    {
    $today=date("Y-m-d");
    $array=split( "-",$today);
    $current_year=$array[0];
    $current_month=$array[1];
	$current_day=$array[2];

        return "?max_records=0&current_date=$current_day-$current_month-$current_year&date=$day-$month-$year";
    }


    /*
        Return the HTML for the current month
    */
    function getCurrentMonthView()
    {
        $d = getdate(time());
        return $this->getMonthView($d["mon"], $d["year"]);
    }
    

    /*
        Return the HTML for the current year
    */
    function getCurrentYearView()
    {
        $d = getdate(time());
        return $this->getYearView($d["year"]);
    }
    
    
    /*
        Return the HTML for a specified month
    */
    function getMonthView($month, $year,$client_id)
    {
        return $this->getMonthHTML($month, $year,1,$client_id);
    }
    

    /*
        Return the HTML for a specified year
    */
    function getYearView($year)
    {
        return $this->getYearHTML($year);
    }
    
    
    
    /********************************************************************************
    
        The rest are private methods. No user-servicable parts inside.
        
        You shouldn't need to call any of these functions directly.
        
    *********************************************************************************/


    /*
        Calculate the number of days in a month, taking into account leap years.
    */
    function getDaysInMonth($month, $year)
    {
        if ($month < 1 || $month > 12)
        {
            return 0;
        }
   
        $d = $this->daysInMonth[$month - 1];
   
        if ($month == 2)
        {
            // Check for leap year
            // Forget the 4000 rule, I doubt I'll be around then...
        
            if ($year%4 == 0)
            {
                if ($year%100 == 0)
                {
                    if ($year%400 == 0)
                    {
                        $d = 29;
                    }
                }
                else
                {
                    $d = 29;
                }
            }
        }
    
        return $d;
    }


    /*
        Generate the HTML for a given month
    */
    function getMonthHTML($m, $y, $showYear = 1,$client_id)
    {
        $s = "";
        
        $a = $this->adjustDate($m, $y);
        $month = $a[0];
        $year = $a[1];        
        
    	$daysInMonth = $this->getDaysInMonth($month, $year);
    	$date = getdate(mktime(12, 0, 0, $month, 1, $year));
    	
    	$first = $date["wday"];
    	$monthName = $this->monthNames[$month - 1];
    	
    	$prev = $this->adjustDate($month - 1, $year);
    	$next = $this->adjustDate($month + 1, $year);
    	
    	if(strlen($next[1])==1)	{$next[1]='0'.$next[1];};
    	if(strlen($prev[1])==1)	{$prev[1]='0'.$prev[1];};
    	if ($showYear == 1)
    	{
    	    $prevMonth = $this->getCalendarLink($prev[0], $prev[1]);
    	    $nextMonth = $this->getCalendarLink($next[0], $next[1]);
    	}
    	else
    	{
    	    $prevMonth = "";
    	    $nextMonth = "";
    	}
    	
    	$header = $monthName . (($showYear > 0) ? " " . $year : "");
    	
    	
    	$s .= "<table width=\"100%\" height=\"100\">\n";
    	$s .= "<tr align=\"center\" valign=\"top\" class=\"link-petit\" height=\"14\" bgcolor=\"#6AA5BA\" >\n";
    	$s .= "<td >" . (($prevMonth == "") ? "&nbsp;" : "<a href=\"$prevMonth\" ><font color=\"#FFFFFF\"><b>&lt;&lt;</b></font></a>")  . "</td>\n";
    	$s .= "<td colspan=\"5\"><font color=\"#FFFFFF\"><b>$header</b></font></td>\n";
    	$s .= "<td >" . (($nextMonth == "") ? "&nbsp;" : "<a href=\"$nextMonth\" ><font color=\"#FFFFFF\"><b>&gt;&gt;</b></font></a>")  . "</td>\n";
    	$s .= "</tr>\n";
    	
    	$s .= "<tr align=\"center\" valign=\"top\" class=\"link-petit\" height=\"10\" bgcolor=\"#B6E3DB\">\n";
    	$s .= "<td >" . $this->dayNames[($this->startDay)%7] . "</td>\n";
    	$s .= "<td >" . $this->dayNames[($this->startDay+1)%7] . "</td>\n";
    	$s .= "<td >" . $this->dayNames[($this->startDay+2)%7] . "</td>\n";
    	$s .= "<td >" . $this->dayNames[($this->startDay+3)%7] . "</td>\n";
    	$s .= "<td >" . $this->dayNames[($this->startDay+4)%7] . "</td>\n";
    	$s .= "<td >" . $this->dayNames[($this->startDay+5)%7] . "</td>\n";
    	$s .= "<td >" . $this->dayNames[($this->startDay+6)%7] . "</td>\n";
    	$s .= "</tr>\n";
    	
        
        $date_beg=date("Y-m-d",strtotime($month."/01/".$year));
        $date_end=date("Y-m-d",strtotime($month."/".$daysInMonth."/".$year));
       
        
        $sql1="SELECT date_, max(FK_preres_type) as max_prers FROM preres_jour WHERE preres_jour.FK_client = '$client_id' AND preres_jour.date_ >= '$date_beg' ANd preres_jour.date_ <= '$date_end'  GROUP BY date_";
        $rs1=exo_query($sql1);
        //echo "test".$sql1;
        while($row1=exo_fetch_array($rs1)){
            if($row1['max_prers']>0)$elt1_array[$row1['date_']]=1;else $elt1_array[$row1['date_']]=-1;
            //echo $row1['date_']." value : ".$elt1_array[$row1['date_']]."<br>";
            //$elt1_array[$row1['date_']]=1;
            }
        $semaine_affect_new=exo_get_elt("SELECT semaine_affect_new FROM client WHERE ID='".$client_id."'");
        if($semaine_affect_new){
            $sem_date_beg=date("Y-m-d",strtotime($month."/01/".$year));
            $sem_date_end=date("Y-m-d",strtotime($month."/".$daysInMonth."/".$year));
            }else{
            $sem_date_beg="2222-".date("m-d",strtotime($month."/01/2022"));
            $sem_date_end="2222-".date("m-d",strtotime($month."/".$daysInMonth."/2022"));
        }
       //     echo "beg". $sem_date_beg."<br>";
       // echo "end". $sem_date_end."<br>";
        $sql2="SELECT GREATEST('$sem_date_beg',dateopen) as semainier_beg, dateopen, LEAST('$sem_date_end',dateclose) as semainier_end, periodicity, FK_semainier  FROM
        semainier,semaine_affect WHERE semaine_affect.FK_semainier=semainier.ID  AND semainier.FK_client = '$client_id'
        AND (('$sem_date_beg' >= semaine_affect.dateopen  AND semaine_affect.dateclose>='$sem_date_beg') OR ('$sem_date_beg' <= semaine_affect.dateopen  AND semaine_affect.dateopen<='$sem_date_end'))";
    	//echo $sql2;  
        $rs2=exo_query($sql2);
        
        while($row2=exo_fetch_array($rs2)){
            $sem_array=array();
            $sql_sem="SELECT day, MAX(FK_preres_type) as max_preres FROM preres WHERE FK_semainier='".$row2['FK_semainier']."' GROUP BY day ORDEr BY day ASC";
            $rs_sem=exo_query($sql_sem);
            
        while($row_sem=exo_fetch_array($rs_sem)){
            if($row_sem['max_preres']>0)$sem_array[$row_sem['day']]=1;
            }
            $d=1;
            while ($d <= $daysInMonth)
    	     {
            //    echo "test date ".$year."<br>";
                if($semaine_affect_new){
                   $sem_date=date("Y-m-d",strtotime($month."/".$d."/".$year));  
                    }else{
                  $sem_date="2222-".date("m-d",strtotime($month."/".$d."/2022"));
                  }
              $date=date("Y-m-d",strtotime($month."/".$d."/20".$year));
              //
              //echo "dateopen :".$row2['dateopen']." "."periodicity :".$row2['periodicity']. " number week ".week_number($date). "  to ".week_number($row2['dateopen'],$year)."<br>"; ;
              //$include=( week_number($date) % $row2['periodicity'] == week_number($row2['dateopen'])% $row2['periodicity'] );
              //$include1=week_number($date) % $row2['periodicity'];
              //$include2=week_number($row2['dateopen'])% $row2['periodicity'];
              //echo " include: ".$include."compare ".$include1." to ".$include2."<br>";
              if($semaine_affect_new){
                  $diff_in_weeks=difference_in_week($date,$row2['dateopen']);
                  }else{
                   $diff_in_weeks=difference_in_week($date,$row2['dateopen'],$year);    
                      }
              if(!$elt2_array[$d] && $sem_date>=$row2['semainier_beg'] && $sem_date <=$row2['semainier_end'] && ($row2['periodicity']==0 || ( $diff_in_weeks % $row2['periodicity'] == 0 ))){
                  
                  $day_of_week=($d+$first+6-1)%7+1;
                 //echo "test d ".$d." and week day ".$day_of_week."<br>";
                  if($sem_array[$day_of_week]==1){
                      $elt2_array[$d]=1;
                   //   echo "pushing".$d."<br>";
                      
                      }
                  }
              
              $d++;  
              } 
           // echo "from ".$row2['semainier_beg']." to ".$row2['semainier_end']."<br>";
            }
        
        
        
        
    	// We need to work out what date to start at so that the first appears in the correct column
    	$d = $this->startDay + 1 - $first;

		while ($d > 1)
    	{
    	    $d -= 7;
    	}

        
        
        // Make sure we know when today is, so that we can use a different CSS style
        $today = getdate(time());
    	$date_today=date("Y-m-d",strtotime($today["mon"] ."/".$today["mday"]."/".$today["year"]));
	
        	
        
        
        
        
    	while ($d <= $daysInMonth)
    	{
    	    $s .= "<tr class=\"link-petit\" align=\"center\" valign=\"top\" height=\"12\">\n";
    	    
    	    for ($i = 0; $i < 7; $i++)
    	    {
        	    $class = ($year == $today["year"] && $month == $today["mon"] && $d == $today["mday"]) ? "calendarToday" : "calendar";
    	        $s .= "<td ";

    	        if ($d > 0 && $d <= $daysInMonth)
    	        {
    	            $date=date("Y-m-d",strtotime($month."/".$d."/"."20".$year));
	//echo "test".$date." compare ".$elt1_array[$date]."<br>";			
					$sem_date="2222-".date("m-d",strtotime($month."/".$d."/2022"));
    	          $elt1=$elt1_array[$date];
                  $elt2=$elt2_array[$d];
    	        //$elt1=exo_get_elt(	"SELECT FK_preres_type FROM preres_jour WHERE preres_jour.FK_client = '$client_id' AND preres_jour.date_ = '$date' ORDER BY FK_preres_type DESC");
		//		$elt2=exo_get_elt(	"SELECT preres_type.ID FROM preres_type,preres,semainier,semaine_affect WHERE  preres.FK_semainier=semainier.ID AND semaine_affect.FK_semainier=semainier.ID AND '$sem_date' >= semaine_affect.dateopen AND '$sem_date' <= semaine_affect.dateclose AND semainier.FK_client = '$client_id' AND preres.FK_preres_type=preres_type.ID AND preres.day=(WEEKDAY('$date')+1) ORDER BY ID DESC");
				$elt3=exo_get_elt("SELECT ID FROM dayoff WHERE date_='$date' AND FK_client=0");
                                if($elt3>0){
                                    $exception=exo_get_elt("SELECT count(ID) FROM dayoff WHERE date_='$date' AND FK_client='$client_id' AND off=1");
                                    if($exception>0)$elt3=0;
                                        }    
                                
                       //   if($d==14)echo "test".$elt1." ".($elt1=="");      
    	         if(($elt2 && $elt2!="" && $elt1=="" && $elt3=="") || ( $elt1 && $elt1>0)){$color = 'color=\"#FF0000\"';}else{$color = 'color=\"#000000\"';}


	if($date==$date_today){$color_bg = 'bgcolor=\"#B6E3DB\"' ;}else{$color_bg = '';}

				    $link = $this->getDateLink($d, $month, $year);
				    //if(
    	            $s .= (  "$color_bg><a onclick=\"javascript:load_agenda('$d','$month','$year');\" href=\"#anchor\" class='link-petit'><font $color >$d</font></a>");

    	        }
    	        else
    	        {
    	            $s .= ">&nbsp;";
    	        }
      	        $s .= "</td>\n";       
        	    $d++;
    	    }
    	    $s .= "</tr>\n";    
    	}
    	
    	$s .= "</table>\n";
    	
    		return $s;
    }
    
    
    /*
        Generate the HTML for a given year
    */
    function getYearHTML($year)
    {
        $s = "";
    	$prev = $this->getCalendarLink(0, $year - 1);
    	$next = $this->getCalendarLink(0, $year + 1);
        
        $s .= "<table class=\"calendar\" border=\"0\">\n";
        $s .= "<tr>";
    	$s .= "<td align=\"center\" valign=\"top\" align=\"left\">" . (($prev == "") ? "&nbsp;" : "<a href=\"$prev\">&lt;&lt;</a>")  . "</td>\n";
        $s .= "<td class=\"calendarHeader\" valign=\"top\" align=\"center\">" . (($this->startMonth > 1) ? $year . " - " . ($year + 1) : $year) ."</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" align=\"right\">" . (($next == "") ? "&nbsp;" : "<a href=\"$next\">&gt;&gt;</a>")  . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(0 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(1 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(2 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(3 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(4 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(5 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(6 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(7 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(8 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(9 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(10 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(11 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "</table>\n";
        
        return $s;
    }

    /*
        Adjust dates to allow months > 12 and < 0. Just adjust the years appropriately.
        e.g. Month 14 of the year 2001 is actually month 2 of year 2002.
    */
    function adjustDate($month, $year)
    {
        $a = array();  
        $a[0] = $month;
        $a[1] = $year;
        
        while ($a[0] > 12)
        {
            $a[0] -= 12;
            $a[1]++;
        }
        
        while ($a[0] <= 0)
        {
            $a[0] += 12;
            $a[1]--;
        }
        
        return $a;
    }

    /* 
        The start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    var $startDay = 0;

    /* 
        The start month of the year. This is the month that appears in the first slot
        of the calendar in the year view. January = 1.
    */
    var $startMonth = 1;

    /*
        The labels to display for the days of the week. The first entry in this array
        represents Sunday.
    */
    var $dayNames = array("D", "L", "M", "M", "J", "V", "S");
    
    /*
        The labels to display for the months of the year. The first entry in this array
        represents January.
    */
    var $monthNames = array("Janvier", "F�vrier", "Mars", "Avril", "Mai", "Juin",
                            "Juillet", "Aout", "Septembr", "Octobre", "Novembre", "Decembre");
                            
                            
    /*
        The number of days in each month. You're unlikely to want to change this...
        The first entry in this array represents January.
    */
    var $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    
}



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Calendrier Exodial</title>
<link href="../../../common/styles.css" rel="stylesheet" type="text/css">
<script language="javascript">
function load_agenda(d,month,year){
	if(parent.principal.document.location.href.indexOf("JX")>=0){
		//alert("test"+  d+"-"+month+"-"+year);
		parent.principal.displayDate(d,month,year);
		}else{
	parent.principal.document.location.href ="<? echo "../../".$URL_agenda."?max_records=0&current_date=$current_day-$current_month-$current_year&date=";?>"+  d+"-"+month+"-"+year;
}
}

</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight='0'  >

<?
$date1=date("d-m-y");
$array=split( "-",$date1);

if($month==""){$month=$array[1];;};
if($year==""){$year=$array[2];};
$calendar = new Calendar();
echo $calendar->getMonthView($month,$year,$sess_cid);
?>
</body>
</html>
