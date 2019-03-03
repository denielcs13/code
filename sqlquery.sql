SELECT i.customer_id      AS user_id
     , COUNT(*)          AS item_count
     , SUM(i.total_price)      AS cost
     ,CONCAT(p.fname,' ',p.lname) AS name
     ,p.phone
     ,p.email
     FROM  orders i
LEFT  JOIN (
   SELECT id,fname,phone,email
   FROM   customers
   GROUP  BY 1
   ) p ON p.id= i.customer_id
LEFT  JOIN (
   SELECT order_id, payment_method,status,created
   FROM   order_info
   GROUP  BY 1
   ) e ON e.order_id = i.id
GROUP BY 1;
