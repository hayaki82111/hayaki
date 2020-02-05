import sys,os
from PIL import image
import numpy as np
import gyudon #作ってない

if (sys.argv)<=1:
    print("gyudon-checker.py (ファイル名)")
    quit()

image_size=50
category=[
    "普通","紅ショウガ",
    "ネギ玉","チーズ"
    ]
calories=[656,658,768,836]

X=[]
files=[]

for fname in sys.argv[1:]:#fname->filename
    img=Image.open(fname)
    img=img.convert('RGB')
    img=img.resize((image_size,image_size))
    in_data=np.asarray(img)
    X.append(in_data)
    files.append(fname)

X=np.array(X)


model=gyudon.build_model(x.shape[1:]) #gyudon.build_mode->ほかのファイルで作ったネットワーク
model.load_weights(".image/gyudon-model.hbf5")

html=""
pre=model.predict(X)#学習済みモデルを使った予測
for i,p in enumerate(pre):
    y=p.argmax()
    print("+入力:",files[i])
    print("|牛丼名:",category[y])
    print("|カロリー:",calories[y])
###ここまでモデルにほかのデータを入れるためのプログラム

###################ここからテストデータの検証
test_iterator=iter(test_lorder)#引数はテストのデータセットを加工した物
test_data,teacher_loader=test_iterator.next()
results=model(Variable(test_data))
_,predicted_label=torch.max(results.data,1)

location=1#データセットの中の何番目か

plt.imshow(test_data[location].numpy().reshape(64,64),cmap="inferno",interpolation="bicubic")
print('ラベル:',predicted_label[location])

################

#####クラスごとの正答率の検証(10くらす)
class_correct=list(0. for i in range(10))
class_total=list(0. for i in range(10))

with torch.no_grad():
    for data in test_data_loader:
        test_data,teacher_labels=data
        results=model(test_data)
        _,predicted=torch.max(results,1)
        c=(predicted==teacher_labels).squeeze()

        for i in range(4):
            label=teacher_labels[i]

            class_correct[label]+=c[i].item()
            class_total[label]+=1

for i in range(10):
    print('%5s クラスの正解率は: %2d %%' % (class_names[i],100*class_correct[i]/class_total[i])) #class_namesは正常と異常を入れる



#＃＃＃＃＃＃＃＃＃＃＃
