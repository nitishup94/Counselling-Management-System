# Counselling-Management-System
Student counselling according to his preference and category

--------installation----------------

1 => upload sql file in your database.

2 => set status in student table.

 a) flag 0 =>ready for allotment.
 b) flag 1 => alloted seat.
 c) flag 2 => Not alloted seat.

3 => branch,category,clgbranch,college and seat table data fill according to field.

  a) branch => branch table has branch code and branch name details.
  
  b) category => category table has category code and category name. 
  
  c) clgbranch => clgbranch table has college code and branch code .
  
  d) college =>  college table has college name and college code.
  
  e) seat  => seat table has colleges code with his branch code and  category-wise seat details.

4 => allotment table contain alloted output.

5 => student table has student details with mark ,roll number and rank is required for counselling process so upload student data according to field,
     or take input data according to field.

6 => pref table has preference of college code with his branch code . you can take preference from students.

7 => conn.php edit your database connection.
 
8 => Go to home page 

    a)start from > in this field you can enter number from where you want to start. mostly you can use ( 0 or 1).
    
    b) No. of loops > how many loops/call means that if you enter 10 then every call has 10 loops.

9 => wait for alert message after alert redirect auto allotment result page where list of students who get the college with category details.
     


               note---> you can export or print the data .
       


                                      thankyou !


       Developed by : Nitish Kumar Upadhyay
       Email : nitishapp9455@gmail.com

       
