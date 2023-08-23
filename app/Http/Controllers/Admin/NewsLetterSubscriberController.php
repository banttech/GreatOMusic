<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsLetterSubscriber;
use DB;

class NewsLetterSubscriberController extends Controller
{
  public function index()
  {
//     DB::query("INSERT INTO `email_list` (`id`, `email`, `date`) VALUES
//     (2117, '1aG9_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-06-27 00:21:49'),
// (2178, '1Onx_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-08-04 02:59:44'),
// (2056, '2612.su.p.erser.vis2.02.1@gmail.com\r\n', '2023-04-18 13:43:10'),
// (2126, '38VL_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-11 01:15:46'),
// (2144, '4wzE_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-14 04:23:59'),
// (2052, '5H0Z_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-13 06:01:54'),
// (2187, '7gv4_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-08-10 17:01:30'),
// (2108, '7nFy_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-06-14 23:02:40'),
// (2099, '9Qfb_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-06-06 06:08:08'),
// (2080, 'abc@gmail.com', '2023-05-17 10:35:09'),
// (2073, 'abhishek@gmail.com', '2023-05-02 12:08:26'),
// (2141, 'agwbabycakes20@yahoo.ca', '2023-07-13 08:16:37'),
// (2084, 'akash.banttech@gmail.com', '2023-05-18 16:14:55'),
// (2100, 'akashsharma25091995@gmail.com', '2023-06-06 06:40:57'),
// (2112, 'alexmirr113@gmail.com', '2023-06-21 22:40:04'),
// (2175, 'alicia769@comcast.net', '2023-07-31 18:48:29'),
// (2107, 'ammar.banttech@gmail.com', '2023-06-14 07:11:55'),
// (2067, 'ao6d_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-29 11:47:08'),
// (2061, 'Bill.Fritsch@hotmail.com', '2023-04-22 09:48:03'),
// (2048, 'bor.is.1980.s.e.c.e.n.ov@gmail.com\r\n', '2023-04-10 22:14:53'),
// (2075, 'bSCG_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-05-08 17:54:39'),
// (2096, 'CFYq_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-06-02 14:12:56'),
// (2134, 'cherise.higgins@avsquad.com', '2023-07-11 20:54:02'),
// (2135, 'cherise.higgins@avsquad.com', '2023-07-11 21:01:55'),
// (2169, 'claudiamcelya@gmail.com', '2023-07-26 20:15:58'),
// (2059, 'CMgS_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-22 06:15:40'),
// (2123, 'cmlewis04@gmail.com', '2023-07-08 16:34:04'),
// (2125, 'dalejandro2181955@gmail.com', '2023-07-09 02:05:20'),
// (2145, 'dannylokwokhing@netvigator.com', '2023-07-14 16:29:41'),
// (2130, 'djones026@yahoo.com', '2023-07-11 11:26:09'),
// (2171, 'DNfk_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-28 22:43:27'),
// (2186, 'donnalcook@hotmail.com', '2023-08-09 19:40:13'),
// (2179, 'DvHw_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-08-07 18:37:22'),
// (2111, 'e4MP_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-06-21 08:45:10'),
// (2082, 'eBGJ_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-05-18 02:16:25'),
// (2093, 'Elroy0@hotmail.com', '2023-05-30 21:33:14'),
// (2189, 'ervin1983@mail.com', '2023-08-11 05:58:22'),
// (2106, 'fELH_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-06-12 14:39:50'),
// (2173, 'fishwiz0100@yahoo.com', '2023-07-30 06:47:16'),
// (2146, 'freitas@ds18.com', '2023-07-15 01:43:40'),
// (2142, 'georgesssh@hotmail.com', '2023-07-14 01:22:35'),
// (2087, 'girtalos@yandex.com', '2023-05-24 02:32:01'),
// (2195, 'GT0m_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-08-14 06:18:08'),
// (2156, 'GVKX_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-20 09:35:40'),
// (2083, 'hello@gmail.com', '2023-05-18 13:59:51'),
// (2057, 'hLQT_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-20 01:04:14'),
// (2162, 'hvnlyanaci1521@gmail.com', '2023-07-24 00:54:54'),
// (2072, 'i1UY_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-05-02 07:00:06'),
// (2078, 'iKGt_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-05-12 11:21:49'),
// (2159, 'ImZe_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-21 21:32:03'),
// (2194, 'IO6m_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-08-14 03:15:03'),
// (2065, 'Ixg7_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-24 21:37:28'),
// (2200, 'jamesedger679@gmail.com', '2023-08-17 12:26:03'),
// (2124, 'jnb2@cox.net', '2023-07-08 19:14:20'),
// (2054, 'jw.jwebster@gmail.com', '2023-04-16 01:53:29'),
// (2155, 'kayhibler@q.com', '2023-07-20 06:13:31'),
// (2158, 'Kaylin_Beier@yahoo.com', '2023-07-21 09:07:49'),
// (2161, 'kmnse5@sbcglobal.net', '2023-07-22 22:20:46'),
// (2044, 'kushgra7@gmail.com', '2023-04-08 07:30:53'),
// (2147, 'Kvzn_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-17 00:16:53'),
// (2042, 'KXR9_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-05 15:57:55'),
// (2165, 'lena@swva.net', '2023-07-25 12:29:20'),
// (2053, 'li.der.p.r.o.mo.2.01.5.su.pe.r@gmail.com\r\n', '2023-04-13 15:31:07'),
// (2071, 'LIPw_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-05-01 04:41:37'),
// (2167, 'm.aljaibaji@gmail.com', '2023-07-25 22:40:16'),
// (2199, 'm.mcanelly@att.net', '2023-08-17 09:45:11'),
// (2113, 'M04B_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-06-23 15:56:08'),
// (2152, 'maria_marcelli@yahoo.com', '2023-07-19 22:04:47'),
// (2041, 'mashfiqurrr@gmail.com', '2023-04-03 20:16:25'),
// (2143, 'mendezban@yahoo.com', '2023-07-14 01:39:14'),
// (2168, 'Nfx4_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-25 23:26:19'),
// (2131, 'nicholaslauhk@yahoo.com.hk', '2023-07-11 12:27:33'),
// (2172, 'nSu5_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-29 10:13:39'),
// (2148, 'NTSH_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-17 02:38:00'),
// (2149, 'odiseo50@gmail.com', '2023-07-18 00:00:49'),
// (2045, 'p.u.t.i.l.oi.van7.3567812.3@gmail.com\r\n', '2023-04-09 00:44:19'),
// (2043, 'p.u.tiloi.v.an73.56.78.123@gmail.com\r\n', '2023-04-08 01:21:56'),
// (2188, 'p90m_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-08-10 17:31:44'),
// (2066, 'Paolo_Gerlach@gmail.com', '2023-04-28 01:35:26'),
// (2192, 'pbmanikandan@gmail.com', '2023-08-13 07:58:18'),
// (2190, 'peppercsw@yahoo.com', '2023-08-11 08:37:17'),
// (2177, 'pgerling43@gmail.com', '2023-08-01 18:13:03'),
// (2191, 'phillip.caton@gmail.com', '2023-08-11 15:02:41'),
// (2091, 'prashant@banttech.com', '2023-05-29 08:45:30'),
// (2094, 'prshntsxen@gmail.com', '2023-05-31 14:06:57'),
// (2077, 'Q12h_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-05-12 03:15:41'),
// (2185, 'Robin.Hartmann44@hotmail.com', '2023-08-09 17:47:01'),
// (2088, 'rpew_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-05-24 05:17:05'),
// (2118, 'RW6H_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-02 00:44:18'),
// (2196, 'samantharitzer@gmail.com', '2023-08-14 19:44:17'),
// (2198, 'sandy.johannsen@yahoo.com', '2023-08-16 14:12:38'),
// (2183, 'scottw@centurylink.net', '2023-08-09 00:41:57'),
// (2140, 'sein_maung@hotmail.com', '2023-07-13 00:01:30'),
// (2133, 'shart@hmelegal.com', '2023-07-11 17:19:44'),
// (2086, 'sirfak@yandex.com', '2023-05-23 21:58:00'),
// (2157, 'siruss59@cox.net', '2023-07-20 19:17:25'),
// (2138, 'SQB0_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-12 12:04:45'),
// (2150, 'stewartcarol45@gmail.com', '2023-07-18 00:56:48'),
// (2058, 'sZjx_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-20 20:02:07'),
// (2163, 's_sasikumar@mail.com', '2023-07-24 16:02:07'),
// (2089, 'tanmay@banttech.com', '2023-05-26 11:41:17'),
// (2068, 'tFqG_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-29 20:22:05'),
// (2182, 'topher413@icloud.com', '2023-08-08 11:39:35'),
// (2128, 'tristinpatterson11@gmail.com', '2023-07-11 09:12:36'),
// (2122, 'u9TQ_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-06 06:59:28'),
// (2154, 'uplapshraddha_04@rediffmail.com', '2023-07-20 04:46:35'),
// (2095, 'voltech.live@gmail.com', '2023-05-31 17:23:01'),
// (2184, 'wendy2001@nate.com', '2023-08-09 03:25:24'),
// (2170, 'w_muzio@yahoo.com', '2023-07-27 14:20:49'),
// (2069, 'XQOE_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-04-30 02:02:18'),
// (2127, 'xslW_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-11 07:54:01'),
// (2129, 'YdxC_generic_c52e8514_www.greatomusic.com@data-backup-store.com', '2023-07-11 09:38:32'),
// (2153, 'zhang.barbara@yahoo.com', '2023-07-20 02:28:20')
//     ");
    $subscribers = NewsLetterSubscriber::orderBy('id', 'desc')->get();
    $pageTitle = 'Manage Subscribers';
    return view('admin.newslettersubscriber.index', compact('subscribers', 'pageTitle'));
  }

  public function delete($id)
  {
    NewsLetterSubscriber::find($id)->delete();
    return redirect()->back()->with('success', 'Unsubscribed  successfully');
  }
}
