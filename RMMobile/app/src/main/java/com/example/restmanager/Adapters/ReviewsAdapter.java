package com.example.restmanager.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.DrawableRes;

import com.example.restmanager.Model.Menu;
import com.example.restmanager.Model.Review;
import com.example.restmanager.Model.User;
import com.example.restmanager.R;
import com.example.restmanager.databinding.ActivityRestaurantDetailsBinding;

import java.util.ArrayList;

public class ReviewsAdapter extends BaseAdapter {

    private ActivityRestaurantDetailsBinding binding;
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Menu> menus;
    private Review review = new Review();
    private ArrayList<Review> reviews;
    private User user;

    public ReviewsAdapter(Context context, ArrayList<Review> reviews) {
        this.context = context;
        this.reviews = reviews;
    }

    @Override
    public int getCount() {
        return reviews.size();
    }

    @Override
    public Object getItem(int position) {
        return reviews.get(position);
    }

    @Override
    public long getItemId(int position) {
        return reviews.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater == null)
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        if(convertView == null)
            convertView = inflater.inflate(R.layout.item_review, null);

        ReviewsAdapter.ViewHolderList viewHolderList = (ReviewsAdapter.ViewHolderList) convertView.getTag();
        if(viewHolderList == null){
            viewHolderList = new ViewHolderList(convertView);
            convertView.setTag(viewHolderList);
        }
        viewHolderList.update(reviews.get(position));

        return convertView;
    }

    public class ViewHolderList{

        private TextView tvUseNam;
        private TextView tvStars;
        private TextView reviewText;
        private ImageView imgView;

        public ViewHolderList(View view) {
            tvUseNam = view.findViewById(R.id.tvUseNam);
            tvStars = view.findViewById(R.id.tvStars);
            reviewText = view.findViewById(R.id.tvReviewText);
            imgView = view.findViewById(R.id.imgStar);
        }
        public void update(Review review){
            tvUseNam.setText("" + review.getUserId());
            tvStars.setText(review.getStars() + "/5");
            reviewText.setText(review.getDescription());
            imgView.setImageResource(R.drawable.ic_action_name);
        }
    }
}
